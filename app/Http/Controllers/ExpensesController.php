<?php
declare(strict_types=1);

namespace App\Http\Controllers;

class ExpensesController extends EntryController {

    protected string $entryType = "/expense";
}