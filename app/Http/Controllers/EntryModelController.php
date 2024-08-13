<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EntryModelController extends Controller {

    protected string $entryType = "/model";

}