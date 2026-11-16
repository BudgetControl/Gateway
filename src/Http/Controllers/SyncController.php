<?php
namespace Budgetcontrol\Gateway\Http\Controllers;

use Budgetcontrol\Gateway\Facade\AwsCognitoClient as AwsCognito;
use Budgetcontrol\Library\Model\Workspace;
use GuzzleHttp\Client;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/** Exposes the internal Sync service using the existing authenticated API. */
final class SyncController extends Controller
{
    public function forward(Request $request, Response $response, array $args): Response
    {
        $action = $args['action'] ?? '';
        if (!in_array($action, ['eligibility', 'banks', 'start', 'complete', 'connections', 'sync'], true)) return response(['error' => 'Not found'], 404);
        $body = $request->getParsedBody() ?: [];
        $identity = $body['token'] ?? [];
        $verified = $request->getAttribute('verified_access_token');
        if (!$verified) return response(['error' => 'Unauthorized'], 401);
        $claims = AwsCognito::decodeAccessToken($verified);
        if (empty($identity['username']) || !hash_equals((string) $identity['username'], (string) ($claims['username'] ?? ''))) return response(['error' => 'Unauthorized'], 401);
        $workspace = Workspace::where('uuid', $identity['current_ws'] ?? '')->first();
        if (!$workspace || empty($identity['uuid']) || empty($identity['email'])) return response(['error' => 'Invalid authenticated context'], 403);
        unset($body['token']);
        $base = rtrim((string) env('SYNC_API_BASE_URL', ''), '/');
        $secret = (string) env('API_SECRET', '');
        if ($base === '' || $secret === '') return response(['error' => 'Sync service is not configured'], 503);
        try {
            // Avoid the generic client, which logs request headers and bodies in debug mode.
            $client = new Client(['http_errors' => false, 'timeout' => 120, 'connect_timeout' => 5]);
            $result = $client->post($base . '/v1/' . $action, ['headers' => ['X-API-SECRET' => $secret], 'json' => [
                'identity' => ['email' => $identity['email'], 'user_uuid' => $identity['uuid'], 'workspace_id' => $workspace->id], 'data' => $body,
            ]]);
            $data = json_decode((string) $result->getBody(), true);
            return response(is_array($data) ? $data : ['error' => 'Invalid response from Sync'], $result->getStatusCode());
        } catch (\Throwable $e) {
            return response(['error' => 'Sync service unavailable'], 503);
        }
    }
}
