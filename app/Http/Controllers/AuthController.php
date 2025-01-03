<?php
namespace App\Http\Controllers;

use App\Facade\AwsCognito;
use App\Service\JwtService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{

    public function check(Request $request)
    {   
        //log all request
        Log::info('Request: ', $request->all());
        Log::info('Request Path: ', ['path' => $request->path()]);

        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['message' => 'You are not authenticated'], 401);
        }

        $basePath = $this->routes['auth'];
        // check if is valid token and if not refresh the token
        $response = Http::withToken($token)->get("$basePath/check");
        if ($response->status() !== 200) {
            Log::error('Error: on check', ['response' => $response->json()]);
            return response()->json(['message' => 'You are not authenticated'], 401);
        }

        $authToken = $response->header('Authorization');
        if(empty($authToken)) {
            return response()->json(['message' => 'You are not authenticated'], 401);
        }

        return response()->json(['message' => 'You are authenticated', 'authToken' => $authToken], 200, ['Authorization' => 'Bearer ' . $authToken]);
    }

    public function getUserInfo(Request $request)
    {   
        $token = $request->bearerToken();
        $wsUuid = $request->header('X-WS');
        if (!$token) {
            return response()->json(['message' => 'You are not authenticated'], 401);
        }

        $basePath = $this->routes['auth'];
        $response = Http::withToken($token)->withHeader('X-WS',$wsUuid)->get("$basePath/user-info");
        if ($response->status() !== 200) {
            Log::error('Error: on get user info', ['response' => $response->json()]);
            return response()->json(['message' => 'Something went wrong, you are not authenticated'], 401);
        }

        $decoded = JwtService::encodeToken($response->json());
        $response = [
            'token' => $decoded,
            'userInfo' => $response->json()
        ];

        return response()->json($response, 200, ['X-BC-Token' => $decoded]);
    }

    public function logout(Request $request)
    {   
        $basePath = $this->routes['auth'];
        Http::get("$basePath/logout");

        return response()->json("", 200);
    }


    public function signUp(Request $request)
    {
        $basePath = $this->routes['auth'];
        $response = Http::post("$basePath/sign-up", $request->all());
        if ($response->status() !== 201) {
            Log::error('Error: on sign up', ['response' => $response->json()]);
            return response()->json(['message' => 'An error occurred'], 401);
        }

        return $response;
    }

    public function confirmToken(Request $request, $token)
    {
        $basePath = $this->routes['auth'];
        $response = Http::get("$basePath/confirm/$token");
        if ($response->status() !== 200) {
            Log::error('Error: confirm token', ['response' => $response->json()]);
            return response()->json(['message' => 'An error occurred'], 401);
        }

        return $response;
    }

    public function authenticate(Request $request)
    {
        $basePath = $this->routes['auth'];
        $response = Http::post("$basePath/authenticate", $request->all());

        if ($response->status() !== 200) {
            Log::error('Error: on authenticate', ['response' => $response->json()]);
            return response()->json(['message' => 'An error occurred'], 401);
        }

        // get refresh token from body response
        $refreshToken = $response->json()['refresh_token'];
        $accessToken = $response->json()['token'];

        $decodedAccessToken = AwsCognito::decodeAccessToken($accessToken);

        $cacheKey = cacheKey_refreshToken($decodedAccessToken['sub']);
        Cache::put($cacheKey, $refreshToken, Carbon::now()->addDays(30));

        //remove the refresh token from the body of the response
        unset($response->json()['refresh_token']);

        return $response;
    }

    public function resetPassword(Request $request, $token)
    {
        $basePath = $this->routes['auth'];
        $response = Http::put("$basePath/reset-password/$token", $request->all());
        if ($response->status() !== 200) {
            Log::error('Error: reset password', ['response' => $response->json()]);
            return response()->json(['message' => 'An error occurred'], 401);
        }

        return $response;
    }

    public function sendVerifyEmail(Request $request)
    {
        $basePath = $this->routes['auth'];
        $response = Http::post("$basePath/verify-email", $request->all());
        if ($response->status() !== 200) {
            Log::error('Error: on send verify email', ['response' => $response->json()]);
            return response()->json(['message' => 'An error occurred'], 401);
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

        $response = Http::get("$basePath/authenticate/$provider$queryParam");
        if ($response->status() !== 200) {
            Log::error('Error: on authenticate provider '.$provider, ['response' => $response->json()]);
            return response()->json(['message' => 'An error occurred'], 401);
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

        $queryParams = $request->query();
        if($queryParams['code'] === null) {
            Log::info('Error: code is required');
            return response()->json(['message' => 'Code is required'], 400);
        }

        $newQueryParams = [
            'code' => $queryParams['code'],
            'device' => $deviceOnQuery
        ];

        $queryString = http_build_query($newQueryParams);
        $response = Http::get("$basePath/authenticate/token/$provider?$queryString");
        if ($response->status() !== 200) {
            Log::error('Error: on provider token '.$provider, ['response' => $response->json()]);
            return response()->json(['message' => 'An error occurred'], 401);
        }

        // get refresh token from body response
        $refreshToken = $response->json()['refresh_token'];
        $accessToken = $response->json()['token'];

        $decodedAccessToken = AwsCognito::decodeAccessToken($accessToken);

        $cacheKey = cacheKey_refreshToken($decodedAccessToken['sub']);
        Cache::put($cacheKey, $refreshToken, Carbon::now()->addDays(30));

        //remove the refresh token from the body of the response
        unset($response->json()['refresh_token']);

        return $response;
    }

    public function sendResetPasswordMail(Request $request)
    {
        $basePath = $this->routes['auth'];
        $response = Http::post("$basePath/reset-password", $request->all());
        if ($response->status() !== 200) {
            Log::error('Error: on send reset password mail', ['response' => $response->json()]);
            return response()->json(['message' => 'An error occurred'], 401);
        }

        return $response;
    }

    public function getUserInfoByEmail(Request $request, $uuid)
    {
        $basePath = $this->routes['auth'];
        $response = Http::get("$basePath/user-info/by-email/$uuid");
        if ($response->status() !== 200) {
            Log::error('Error: on get user info by email ', ['response' => $response->json()]);
            return response()->json(['message' => 'An error occurred'], $response->status());
        }

        return $response;
    }
}
