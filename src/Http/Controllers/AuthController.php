<?php
namespace Budgetcontrol\Gateway\Http\Controllers;

use Budgetcontrol\Gateway\Facade\AwsCognitoClient as AwsCognito;
use Carbon\Carbon;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Budgetcontrol\Library\Model\User;
use BudgetcontrolLibs\Crypt\Traits\Crypt;
use Budgetcontrol\Gateway\Service\JwtService;

class AuthController extends Controller
{
    use Crypt;

    public function check(Request $request)
    {   
        //log all request
        Log::info('Request: ', $request->getParsedBody() ? ['body' => $request->getParsedBody()] : []);
        Log::info('Request Path: ', ['path' => $request->getUri()->getPath()]);

        $token = $this->getBearerToken($request);
        if (!$token) {
            return response(['message' => 'You are not authenticated'], 401);
        }

        $basePath = $this->routes['auth'];
        // check if is valid token and if not refresh the token
        $response = $this->httpClient()->withToken($token)->get("$basePath/check");
        if ($response->status() !== 200) {
            Log::error('Error: on check', ['response' => $response->json()]);
            return response(['message' => 'You are not authenticated'], 401);
        }

        $authToken = $response->header('Authorization');
        if(empty($authToken)) {
            return response(['message' => 'You are not authenticated'], 401);
        }

        return response(['message' => 'You are authenticated', 'authToken' => $authToken], 200, ['Authorization' => 'Bearer ' . $authToken]);
    }

    public function getUserInfo(Request $request)
    {   
        $token = $this->getBearerToken($request);
        $wsUuid = $request->getHeaderLine('X-WS');
        if (!$token) {
            return response(['message' => 'You are not authenticated'], 401);
        }

        $basePath = $this->routes['auth'];
        $response = $this->httpClient()->withToken($token)->withHeader('X-WS',$wsUuid)->get("$basePath/user-info");
        if ($response->status() !== 200) {
            Log::error('Error: on get user info', ['response' => $response->json()]);
            return response(['message' => 'Something went wrong, you are not authenticated'], 401);
        }

        $decoded = JwtService::encodeToken($response->json());
        $response = [
            'token' => $decoded,
            'userInfo' => $response->json()
        ];

        return response($response, 200, ['X-BC-Token' => $decoded]);
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
        if ($response->status() !== 201) {
            Log::error('Error: on sign up', ['response' => $response->json()]);
            return response(['message' => 'An error occurred'], 401);
        }

        return $response;
    }

    public function confirmToken(Request $request, $token)
    {
        $basePath = $this->routes['auth'];
        $response = $this->httpClient()->get("$basePath/confirm/$token");
        if ($response->status() !== 200) {
            Log::error('Error: confirm token', ['response' => $response->json()]);
            return response(['message' => 'An error occurred'], 401);
        }

        return $response;
    }

    public function authenticate(Request $request)
    {
        $basePath = $this->routes['auth'];
        $response = $this->httpClient()->post("$basePath/authenticate", $request->getParsedBody());

        if ($response->status() !== 200) {
            Log::error('Error: on authenticate', ['response' => $response->json()]);
            return response(['message' => 'An error occurred'], 401);
        }

        // get refresh token from body response
        $refreshToken = $response->json()['refresh_token'];
        $accessToken = $response->json()['token'];

        $decodedAccessToken = AwsCognito::decodeAccessToken($accessToken);

        $cacheKey = cacheKey_refreshToken($decodedAccessToken['username']);
        Cache::put($cacheKey, $refreshToken, Carbon::now()->addDays(30));

        //remove the refresh token from the body of the response
        unset($response->json()['refresh_token']);

        return $response;
    }

    public function resetPassword(Request $request, $token)
    {
        $basePath = $this->routes['auth'];
        $response = $this->httpClient()->put("$basePath/reset-password/$token", $request->getParsedBody());
        if ($response->status() !== 200) {
            Log::error('Error: reset password', ['response' => $response->json()]);
            return response(['message' => 'An error occurred'], 401);
        }

        return $response;
    }

    public function sendVerifyEmail(Request $request)
    {
        $basePath = $this->routes['auth'];
        $response = $this->httpClient()->post("$basePath/verify-email", $request->getParsedBody());
        if ($response->status() !== 200) {
            Log::error('Error: on send verify email', ['response' => $response->json()]);
            return response(['message' => 'An error occurred'], 401);
        }

        return $response;
    }

    public function authenticateProvider(Request $request, $provider)
    {
        $basePath = $this->routes['auth'];

        //check if is an mobile phone
        $queryParam = '';
        if($this->isAndroid($request)) {
            Log::debug('Mobile phone detected');
            $queryParam = '?device=android';
        }

        if($this->isIos($request)) {
            Log::debug('Mobile phone detected');
            $queryParam = '?device=ios';
        }

        $response = $this->httpClient()->get("$basePath/authenticate/$provider$queryParam");
        if ($response->status() !== 200) {
            Log::error('Error: on authenticate provider '.$provider, ['response' => $response->json()]);
            return response(['message' => 'An error occurred'], 401);
        }

        return $response;
    }

    public function providerToken(Request $request, $provider)
    {
        $basePath = $this->routes['auth'];

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

        $queryParams = $request->getQueryParams();
        if($queryParams['code'] === null) {
            Log::info('Error: code is required');
            return response(['message' => 'Code is required'], 400);
        }

        $newQueryParams = [
            'code' => $queryParams['code'],
            'device' => $deviceOnQuery
        ];

        $queryString = http_build_query($newQueryParams);
        $response = $this->httpClient()->get("$basePath/authenticate/token/$provider?$queryString");
        if ($response->status() !== 200) {
            Log::error('Error: on provider token '.$provider, ['response' => $response->json()]);
            return response(['message' => 'An error occurred'], 401);
        }

        // get refresh token from body response
        $refreshToken = $response->json()['refresh_token'];
        $accessToken = $response->json()['token'];

        $decodedAccessToken = AwsCognito::decodeAccessToken($accessToken);

        $cacheKey = cacheKey_refreshToken($decodedAccessToken['username']);
        Cache::put($cacheKey, $refreshToken, Carbon::now()->addDays(30));

        //remove the refresh token from the body of the response
        unset($response->json()['refresh_token']);

        return $response;
    }

    public function sendResetPasswordMail(Request $request)
    {
        $basePath = $this->routes['auth'];
        $response = $this->httpClient()->post("$basePath/reset-password", $request->getParsedBody());
        if ($response->status() !== 200) {
            Log::error('Error: on send reset password mail', ['response' => $response->json()]);
            return response(['message' => 'An error occurred'], 401);
        }

        return $response;
    }

    public function getUserInfoByEmail(Request $request, $uuid)
    {
        $basePath = $this->routes['auth'];
        $response = $this->httpClient()->get("$basePath/user-info/by-email/$uuid");
        if ($response->status() !== 200) {
            Log::error('Error: on get user info by email ', ['response' => $response->json()]);
            return response(['message' => 'An error occurred'], $response->status());
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
    public function finalizeSignUp(Request $request, string $userUuid) { 

        $token = $this->getBearerToken($request);
        $userId = $this->userId($userUuid);

        if($this->checkIfUserIsLogged($userId, $token) === false) {
            return response(['message' => 'You are not authenticated'], 401);
        }

        $payLoad = $request->getParsedBody();
        //first create the workspace
        $basePathWorkspace = $this->routes['workspace'];
        $workspaceResponse = $this->httpClient()->post("$basePathWorkspace/$userId/add", $payLoad['workspace']);
        $data = $workspaceResponse->json();
        $workspaceUuid = $data['workspace']['uuid'];
        $workspaceID = $data['workspace']['id'];

        if($workspaceResponse->status() !== 201) {
            Log::error('Error: on workspace create', ['response' => $workspaceResponse->json()]);
            return response(['message' => 'An error occurred'], $workspaceResponse->status());
        }

        //then create the user wallet
        $basePathWallet = $this->routes['wallet'];
        $walletResponse = $this->httpClient()->post("$basePathWallet/$workspaceID/create", $payLoad['wallet']);
        $data = $walletResponse->json();

        //return the user info
        $basePathAuth = $this->routes['auth'];
        $response = $this->httpClient()->withToken($token)->withHeader('X-WS',$workspaceUuid)
        ->get("$basePathAuth/user-info");

        if ($response->status() !== 200) {
            Log::error('Error: on get user info on finalize sign up', ['response' => $response->json()]);
            return response(['message' => 'Something went wrong, you are not authenticated'], 401);
        }

        $decoded = JwtService::encodeToken($response->json());
        $response = [
            'token' => $decoded,
            'userInfo' => $response->json()
        ];

        return response($response, 200, ['X-BC-Token' => $decoded]);

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
}
