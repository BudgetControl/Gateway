<?php

declare(strict_types=1);

namespace Budgetcontrol\Gateway\Http\Controllers\Bo;

use Illuminate\Support\Facades\Log;
use Budgetcontrol\Gateway\Http\Controllers\NotificationController;

class NotificationOfficeController extends NotificationController
{

    /**
     * Send push notification to the office.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return \Psr\Http\Message\ResponseInterface
     * {
     *   "firebase_tokens": ["YOUR_FIREBASE_TOKENS"],
     *   "to": "DEVICE_TOKEN",
     *   "notification": {
     *     "title": "Titolo della notifica",
     *     "body": "Corpo del messaggio",
     *     "image": "URL_opzionale_immagine"
     *   },
     *   "data": {
     *     "chiave1": "valore1",
     *     "chiave2": "valore2"
     *   }
     * }
     */
    public function sendPush($request, $response)
    {
        try {
            $data = $request->getParsedBody();

            if (empty($data['firebase_tokens']) || empty($data['to']) || empty($data['notification'])) {
                return response(['error' => 'Token or notification data is missing'], 400);
            }

            $payload['tokens'] = $data['firebase_tokens'];

            $httpResponse = $this->httpClient()->post($this->notificationServiceUrl . '/notify/push/send', $payload);
            return $this->handleApiResponse($httpResponse, 'sendPush');
        } catch (\Exception $e) {
            Log::error('Error sending push notification', ['error' => $e->getMessage()]);
            return response(['error' => 'Internal server error'], 500);
        }
    }

    public function sendEmailAdmin($request, $response)
    {
        // Implementation for sending email notifications
        // This method should handle the logic for sending email notifications
        // to the office or business operations.
        return response(['status' => 'Email notification sent successfully']);
    }
}
