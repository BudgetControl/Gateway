<?php
declare(strict_types=1);

namespace Budgetcontrol\Gateway\Http\Controllers;

class IncomingController extends EntryController {

    protected string $entryType = "/income";

}