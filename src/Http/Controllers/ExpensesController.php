<?php
declare(strict_types=1);

namespace Budgetcontrol\Gateway\Http\Controllers;

class ExpensesController extends EntryController {

    protected string $entryType = "/expense";
}