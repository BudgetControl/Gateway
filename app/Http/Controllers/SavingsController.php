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
        return $service->list($wsid);
    }

    public function show(Request $request, $uuid)
    {
        $body = $request->all();
        $wsid = $this->getWorkspaceId($body['token']);
        $queryParams = $request->query();

        $service = $this->getService();
        return $service->getSaving($uuid);
    }

    public function create(Request $request)
    {
        $body = $request->all();
        $wsid = $this->getWorkspaceId($body['token']);
        $queryParams = $request->query();

        $service = $this->getService();
        return $service->create($wsid, $body);
    }

    public function update(Request $request, $uuid)
    {
        $body = $request->all();
        $wsid = $this->getWorkspaceId($body['token']);
        $queryParams = $request->query();

        $service = $this->getService();
        return $service->updateSaving($wsid, $uuid, $body);
    }

    public function delete(Request $request, $uuid)
    {
        $body = $request->all();
        $wsid = $this->getWorkspaceId($body['token']);
        $queryParams = $request->query();

        $service = $this->getService();
        return $service->deleteSaving($wsid, $uuid);
    }
}