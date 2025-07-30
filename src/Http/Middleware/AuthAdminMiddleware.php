<?php

namespace Budgetcontrol\Gateway\Http\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Illuminate\Support\Facades\Log;
use Budgetcontrol\Gateway\Service\JwtService;
use Budgetcontrol\Gateway\Facade\AwsCognitoClient as AwsCognito;
use Slim\Psr7\Response as SlimResponse;

class AuthAdminMiddleware implements MiddlewareInterface
{
    /**
     * Process an incoming server request.
     *
     * @param Request $request
     * @param RequestHandler $handler
     * @return Response
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        // check if the request has an Authorization header
        $jwtAdminSecret = env('JWT_ADMIN_SECRET');
        if (empty($jwtAdminSecret)) {
            Log::error('JWT_ADMIN_SECRET is not set in the environment variables');
            return response([
                'status' => 'error',
                'message' => 'SECRET is not set',
            ], 500);
        }

        $authHeader = $request->getHeaderLine('Authorization');
        if (empty($authHeader)) {
            Log::error('Authorization header is missing');
            return response([
                'status' => 'error',
                'message' => 'Authorization header is missing',
            ], 401);
        }

        // Validate the token
        $token = str_replace('Bearer ', '', $authHeader);
        if($token == $jwtAdminSecret) {
            // If the token is valid, proceed with the request
            return $handler->handle($request);
        }

        return $handler->handle($request);
    }
}
