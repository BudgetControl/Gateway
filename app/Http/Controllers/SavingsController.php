<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use App\Facade\MicroserviceCLient;

class SavingsController extends Controller {

    public function get(Request $request, $uuid)
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $queryParams = $request->query();

        $service = MicroserviceCLient::saving();
        $service->getSaving($uuid);
    }
}