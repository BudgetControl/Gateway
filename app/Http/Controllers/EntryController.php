<?php
namespace App\Http\Controllers;

use App\Models\Workspace;
use App\Trait\Cache;
use App\Trait\Paginator;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EntryController extends Controller
{
    use Paginator, Cache;

    public function list(Request $request)
    {
        $body = $request->all();
        $wsid = Workspace::where('uuid', $body['token']['current_ws'])->first()->id;
        $pageNumber = $request->query()['page'];
        $query = 'page='.$pageNumber;

        $basePath = $this->routes['entry'];
        $cacheKey = "$basePath/$wsid?$query";
        
        if(!$this->isInCache($cacheKey)) {
            $response = Http::get("$basePath/$wsid?$query");
            $data = $response->json();

            if($response->status() !== HttpResponse::HTTP_OK) {
                Log::error('Error: on entry list method', ['response' => $response->json()]);
                return response("An error occurred", HttpResponse::HTTP_INTERNAL_SERVER_ERROR, ['Content-Type' => 'application/json']);
            }
            
            if (json_encode($data) === null) {
                Log::error('Error: on entry list method', ['response' => $response->json()]);
                return response("An error occurred", HttpResponse::HTTP_INTERNAL_SERVER_ERROR, ['Content-Type' => 'application/json']);
            }

            $response = $this->paginateData($data);

            $this->setCache($cacheKey, $response);
        } else {
            $response = $this->getCache($cacheKey);
        }

        return response()->json($response);
    }
}