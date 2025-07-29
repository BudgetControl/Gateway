<?php
declare(strict_types=1);

namespace Budgetcontrol\Gateway\Http\Controllers;

use Budgetcontrol\Gateway\Traits\BuildQuery;
use Budgetcontrol\Library\Model\Workspace;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller {

    private string $notificationServiceUrl;

    public function __construct()
    {
        parent::__construct();
        $this->notificationServiceUrl = $this->routes['notification'];
    }

    public function sendEmail(Request $request, Response $response): Response
    {
        try {
            $data = $request->getParsedBody();
            
            $httpResponse = $this->httpClient()->post($this->notificationServiceUrl . '/notify/email/contact', $data);
            
            return $this->handleApiResponse($httpResponse, 'sendEmail notification');
                
        } catch (\Exception $e) {
            Log::error('Error sending email notification', ['error' => $e->getMessage()]);
            return response(['error' => 'Internal server error'], 500);
        }
    }

    public function recoveryPassword(Request $request, Response $response): Response
    {
        try {
            $data = $request->getParsedBody();
            
            $httpResponse = $this->httpClient()->post($this->notificationServiceUrl . '/notify/email/auth/recovery-password', $data);
            
            return $this->handleApiResponse($httpResponse, 'recoveryPassword notification');
                
        } catch (\Exception $e) {
            Log::error('Error sending recovery password notification', ['error' => $e->getMessage()]);
            return response(['error' => 'Internal server error'], 500);
        }
    }

    public function signUp(Request $request, Response $response): Response
    {
        try {
            $data = $request->getParsedBody();
            
            $httpResponse = $this->httpClient()->post($this->notificationServiceUrl . '/notify/email/auth/sign-up', $data);
            
            return $this->handleApiResponse($httpResponse, 'signUp notification');
                
        } catch (\Exception $e) {
            Log::error('Error sending sign up notification', ['error' => $e->getMessage()]);
            return response(['error' => 'Internal server error'], 500);
        }
    }

    public function budgetExceeded(Request $request, Response $response): Response
    {
        try {
            $data = $request->getParsedBody();
            
            $httpResponse = $this->httpClient()->post($this->notificationServiceUrl . '/notify/email/budget/exceeded', $data);
            
            return $this->handleApiResponse($httpResponse, 'budgetExceeded notification');
                
        } catch (\Exception $e) {
            Log::error('Error sending budget exceeded notification', ['error' => $e->getMessage()]);
            return response(['error' => 'Internal server error'], 500);
        }
    }

    public function workspaceShare(Request $request, Response $response): Response
    {
        try {
            $data = $request->getParsedBody();
            
            $httpResponse = $this->httpClient()->post($this->notificationServiceUrl . '/notify/email/workspace/share', $data);
            
            return $this->handleApiResponse($httpResponse, 'workspaceShare notification');
                
        } catch (\Exception $e) {
            Log::error('Error sending workspace share notification', ['error' => $e->getMessage()]);
            return response(['error' => 'Internal server error'], 500);
        }
    }

    public function saveToken(Request $request, Response $response): Response
    {
        try {
            $data = $request->getParsedBody();

            if(empty($data['token']) || empty($data['user_uuid'])) {
                return response(['error' => 'Token and user UUID are required'], 400);
            }

            $payload['token'] = $data['token'];
            $payload['user_uuid'] = $this->getUserUuid($request);
            $payload['user_agent'] = $request->getHeaderLine('User-Agent');

            $httpResponse = $this->httpClient()->post($this->notificationServiceUrl . '/notify/save/token', $payload);
            return $this->handleApiResponse($httpResponse, 'saveToken');
        } catch (\Exception $e) {
            Log::error('Error saving token', ['error' => $e->getMessage()]);
            return response(['error' => 'Internal server error'], 500);
        }
    }
}