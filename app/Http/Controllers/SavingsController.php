<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use App\Facade\MicroserviceCLient;

class SavingsController extends Controller {

    private function getWorkspaceId($token)
    {
        return Workspace::where('uuid', $token['current_ws'])->first()->id;
    }

    private function getService()
    {
        return MicroserviceCLient::saving();
    }

    public function list(Request $request)
    {
        $body = $request->all();
        $wsid = $this->getWorkspaceId($body['token']);
        $queryParams = $request->query();

        $service = $this->getService();
        $response = $service->getAllSavings($wsid);

        return response($response->toArray(), 200);
    }

    public function show(Request $request, $uuid)
    {
        $body = $request->all();
        $wsid = $this->getWorkspaceId($body['token']);

        $service = $this->getService();
        $response = $service->getSaving($wsid, $uuid);

        return response($response->toArray(), 200);
    }

    public function create(Request $request)
    {
        $body = $request->all();
        $wsid = $this->getWorkspaceId($body['token']);

        $service = $this->getService();
        $response = $service->createSaving($wsid, $body);

        return response($response->toArray(), 201);
    }

    public function update(Request $request, $uuid)
    {
        $body = $request->all();
        $wsid = $this->getWorkspaceId($body['token']);

        $service = $this->getService();
        $response = $service->updateSaving($wsid, $uuid, $body);

        return response($response->toArray(), 200);
    }

    public function delete(Request $request, $uuid)
    {
        $body = $request->all();
        $wsid = $this->getWorkspaceId($body['token']);

        $service = $this->getService();
        $response = $service->deleteSaving($wsid, $uuid);

        return response($response->toArray(), 204);

    }
}