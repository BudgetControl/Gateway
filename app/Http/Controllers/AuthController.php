<?php
namespace App\Http\Controllers;

use App\Service\JwtService;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Response as HttpResponse;
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
            return response()->json(['message' => 'You are not authenticated'], 401);
        }

        $authToken = $response->header('Authorization');
        if(empty($authToken)) {
            return response()->json(['message' => 'You are not authenticated'], 401);
        }

        return new HttpResponse(['message' => 'You are authenticated', 'authToken' => $authToken], 200, ['Authorization' => 'Bearer ' . $authToken]);
    }

    public function getUserInfo(Request $request)
    {   
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['message' => 'You are not authenticated'], 401);
        }

        $basePath = $this->routes['auth'];
        $response = Http::withToken($token)->get("$basePath/user-info");
        if ($response->status() !== 200) {
            return response()->json(['message' => 'You are not authenticated'], 401);
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
        $response = Http::get("$basePath/logout");

        return response()->json("", 200);
    }
}