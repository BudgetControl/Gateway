<?php
namespace Budgetcontrol\Gateway\Http\Controllers;

use Budgetcontrol\Gateway\Facade\AwsCognitoClient as AwsCognito;
use Carbon\Carbon;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Budgetcontrol\Library\Model\User;
use BudgetcontrolLibs\Crypt\Traits\Crypt;
use Budgetcontrol\Gateway\Service\JwtService;
use Budgetcontrol\Gateway\Traits\BuildQuery;

class AuthController extends Controller
{
    use Crypt, BuildQuery;

    public function check(Request $request, Response $response): Response
    {   

        $token = $this->getBearerToken($request);
        if (!$token) {
            $response->getBody()->write(json_encode(['message' => 'You are not authenticated']));
            return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
        }

        $basePath = $this->routes['auth'];
        $apiResponse = $this->httpClient()->withToken($token)->get("$basePath/check");
        
        if ($apiResponse->getStatusCode() !== 200) {
            Log::error('Error: on check', ['response' => $apiResponse->getBody()->getContents()]);
            $response->getBody()->write(json_encode(['message' => 'You are not authenticated']));
            return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
        }

        $authToken = $apiResponse->getHeader('Authorization');
        if(empty($authToken)) {
            $response->getBody()->write(json_encode(['message' => 'You are not authenticated']));
            return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
        }

        $response->getBody()->write(json_encode(['message' => 'You are authenticated', 'authToken' => $authToken]));
        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Authorization', 'Bearer ' . $authToken);
    }

    public function getUserInfo(Request $request, Response $response): Response
    {   
        $token = $this->getBearerToken($request);
        $wsUuid = $request->getHeaderLine('X-WS');
        if (!$token) {
            $response->getBody()->write(json_encode(['message' => 'You are not authenticated']));
            return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
        }

        $basePath = $this->routes['auth'];
        $apiResponse = $this->httpClient()->withToken($token)->withHeader('X-WS',$wsUuid)->get("$basePath/user-info");
        $dataResponse = $apiResponse->getBody()->getContents();

        if ($apiResponse->getStatusCode() !== 200) {
            Log::error('Error: on get user info', ['response' => $dataResponse]);
            $response->getBody()->write(json_encode(['message' => 'Something went wrong, you are not authenticated']));
            return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
        }

        $decoded = JwtService::encodeToken(json_decode($dataResponse, true));
        $data = [
            'token' => $decoded,
            'userInfo' => json_decode($dataResponse, true)
        ];

        $response->getBody()->write(json_encode($data));
        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('X-BC-Token', $decoded);
    }

    public function logout(Request $request)
    {   
        $basePath = $this->routes['auth'];
        $this->httpClient()->get("$basePath/logout");

        return response([], 200);
    }


    public function signUp(Request $request)
    {
        $basePath = $this->routes['auth'];
        $response = $this->httpClient()->post("$basePath/sign-up", $request->getParsedBody());
        $jsonData = json_decode($response->getBody()->getContents(), true);
        if ($response->getStatusCode() !== 201) {
            Log::error('Error: on sign up', ['response' => $jsonData]);
            return response(['message' => 'An error occurred'], 401);
        }

        return $response;
    }

    public function confirmToken(Request $request, Response $response, $arg)
    {
        $basePath = $this->routes['auth'];
        $token = $arg['token'];

        if (!$token) {
            Log::error('Error: confirm token is required');
            return response(['message' => 'Token is required'], 400);
        }

        $response = $this->httpClient()->get("$basePath/confirm/$token");
        $jsonData = json_decode($response->getBody()->getContents(), true);
        if ($response->getStatusCode() !== 200) {
            Log::error('Error: confirm token', ['response' => $jsonData]);
            return response(['message' => 'An error occurred'], 401);
        }

        return $response;
    }

    public function authenticate(Request $request)
    {
        $basePath = $this->routes['auth'];
        $response = $this->httpClient()->post("$basePath/authenticate", $request->getParsedBody());
        $jsonData = json_decode($response->getBody()->getContents(), true);
        if ($response->getStatusCode() !== 200) {
            Log::error('Error: on authenticate', ['response' => $jsonData]);
            return response(['message' => 'An error occurred'], 401);
        }

        $response = $this->storeTokenInCahce($jsonData);

        return $response;
    }

    public function resetPassword(Request $request, Response $response, $arg)
    {
        $basePath = $this->routes['auth'];
        $token = $arg['token'];
        if (!$token) {
            Log::error('Error: reset password token is required');
            return response(['message' => 'Token is required'], 400);
        }

        $response = $this->httpClient()->put("$basePath/reset-password/$token", $request->getParsedBody());
        $jsonData = json_decode($response->getBody()->getContents(), true);
        if ($response->getStatusCode() !== 200) {
            Log::error('Error: reset password', ['response' => $jsonData]);
            return response(['message' => 'An error occurred'], 401);
        }

        return $response;
    }

    public function sendVerifyEmail(Request $request)
    {
        $basePath = $this->routes['auth'];
        $response = $this->httpClient()->post("$basePath/verify-email", $request->getParsedBody());
        $jsonData = json_decode($response->getBody()->getContents(), true);
        if ($response->getStatusCode() !== 200) {
            Log::error('Error: on send verify email', ['response' => $jsonData]);
            return response(['message' => 'An error occurred'], 401);
        }

        return $response;
    }

    public function authenticateProvider(Request $request, Response $response, $arg)
    {
        $basePath = $this->routes['auth'];
        $provider = $arg['provider'];
        //check if is an mobile phone
        $queryParam = [];
        if($this->isAndroid($request)) {
            Log::debug('Mobile phone detected');
            $queryParam['device'] = 'android';
        }

        if($this->isIos($request)) {
            Log::debug('Mobile phone detected');
            $queryParam['device'] = 'ios';
        }

        $response = $this->httpClient()->get("$basePath/authenticate/$provider", $queryParam);
        $jsonData = json_decode($response->getBody()->getContents(), true);

        
        if ($response->getStatusCode() !== 200) {
            Log::error('Error: on authenticate provider '.$provider, ['response' => $jsonData]);
            return response(['message' => 'An error occurred'], 401);
        }

        return $response;
    }

    public function providerToken(Request $request, Response $response, $arg)
    {
        $basePath = $this->routes['auth'];
        $provider = $arg['provider'];

        //check if is an mobile phone
        $deviceOnQuery = '';
        if($this->isAndroid($request)) {
            Log::debug('Mobile phone detected');
            $deviceOnQuery = 'android';
        }

        if($this->isIos($request)) {
            Log::debug('Mobile phone detected');
            $deviceOnQuery = 'ios';
        }

        $queryParams = $this->queryParams($request);
        if($queryParams['code'] === null) {
            Log::info('Error: code is required');
            return response(['message' => 'Code is required'], 400);
        }

        $newQueryParams = [
            'code' => $queryParams['code'],
            'device' => $deviceOnQuery
        ];

        $response = $this->httpClient()->get("$basePath/authenticate/token/$provider", $newQueryParams);
        $jsonData = json_decode($response->getBody()->getContents(), true);

        if ($response->getStatusCode() !== 200) {
            Log::error('Error: on provider token '.$provider, ['response' => $jsonData]);
            return response(['message' => 'An error occurred'], 401);
        }

        $response = $this->storeTokenInCahce($jsonData);

        return $response;
    }

    public function sendResetPasswordMail(Request $request)
    {
        $basePath = $this->routes['auth'];
        $response = $this->httpClient()->post("$basePath/reset-password", $request->getParsedBody());
        $jsonData = $response->getBody()->getContents();

        if ($response->getStatusCode() !== 200) {
            Log::error('Error: on send reset password mail', ['response' => $jsonData]);
            return response(['message' => 'An error occurred'], 401);
        }

        return $response;
    }

    public function getUserInfoByEmail(Request $request, Response $response, $arg)
    {
        $basePath = $this->routes['auth'];
        $response = $this->httpClient()->get("$basePath/user-info/by-email/{$arg['uuid']}");
        $jsonData = json_decode($response->getBody()->getContents(), true);
        if ($response->getStatusCode() !== 200) {
            Log::error('Error: on get user info by email ', ['response' => $jsonData]);
            return response(['message' => 'An error occurred']);
        }

        return $response;
    }

    /**
     * Finalizes the sign-up process for a user.
     *
     * @param Request $request The HTTP request instance.
     * @param string $userUuid The UUID of the user.
     * @return \Illuminate\Http\Response The HTTP response.
     */
    public function finalizeSignUp(Request $request, Response $response, array $arg): Response { 

        $token = $this->getBearerToken($request);
        $userUuid = $arg['userUuid'];
        $userId = $this->userId($userUuid);

        if($this->checkIfUserIsLogged($userId, $token) === false) {
            $response->getBody()->write(json_encode(['message' => 'You are not authenticated']));
            return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
        }

        $payLoad = $request->getParsedBody();
        //first create the workspace
        $basePathWorkspace = $this->routes['workspace'];
        $workspaceResponse = $this->httpClient()->post("$basePathWorkspace/$userId/add", $payLoad);
        $data = json_decode($workspaceResponse->getBody()->getContents(), true);
        $workspaceUuid = $data['workspace']['uuid'];
        $workspaceID = $data['workspace']['id'];

        if($workspaceResponse->getStatusCode() !== 201) {
            Log::error('Error: on workspace create', ['response' => $data]);
            $response->getBody()->write(json_encode(['message' => 'An error occurred']));
            return $response->withStatus($workspaceResponse->getStatusCode())->withHeader('Content-Type', 'application/json');
        }

        //return the user info
        $basePathAuth = $this->routes['auth'];
        $apiResponse = $this->httpClient()->withToken($token)->withHeader('X-WS',$workspaceUuid)
            ->get("$basePathAuth/user-info");

        if ($apiResponse->getStatusCode() !== 200) {
            Log::error('Error: on get user info on finalize sign up', ['response' => $apiResponse->getBody()->getContents()]);
            $response->getBody()->write(json_encode(['message' => 'Something went wrong, you are not authenticated']));
            return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
        }

        $jsonData = json_decode($apiResponse->getBody()->getContents(), true);

        $decoded = JwtService::encodeToken($jsonData);
        $responseData = [
            'token' => $decoded,
            'userInfo' => $jsonData
        ];

        $response->getBody()->write(json_encode($responseData));
        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('X-BC-Token', $decoded);
    }

    /**
     * Check if the user is logged in.
     *
     * This method verifies if the provided user is logged in by checking the given bearer token.
     *
     * @param int $userId The user object to check.
     * @param string $bearerToken The bearer token to validate the user's session.
     * @return bool Returns true if the user is logged in, false otherwise.
     */

    protected function checkIfUserIsLogged(int $userId, string $bearerToken): bool 
    {
        $this->key = env('APP_KEY', null);
        try {
            $user = User::findOrFail($userId);
            $validToken = AwsCognito::validateAuthToken($bearerToken, $user->sub);
            if ($validToken === false) {
                return false;
            }
            return true;
        } catch (\Throwable $e) {
            Log::error("Token expired or not valid:" . $e->getMessage());
            return false;
        }
    }

    /**
     * Stores the provided token payload in the cache.
     *
     * @param array $payload The token data to be cached.
     * @return array The result of the cache storage operation.
     */
    private function storeTokenInCahce(array $payload): array
    {

        // get refresh token from body response
        $refreshToken = $payload['refresh_token'];
        $accessToken = $payload['token'];

        $decodedAccessToken = AwsCognito::decodeAccessToken($accessToken);
        $cacheKey = cacheKey_refreshToken($decodedAccessToken['username']);
        Cache::put($cacheKey, $refreshToken, Carbon::now()->addDays(30));

        //remove the refresh token from the body of the response
        unset($payload['refresh_token']);

        return $payload;

    }
}
