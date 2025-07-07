<?php
declare(strict_types=1);

namespace Budgetcontrol\Gateway\Http\Controllers;


class PayeeController extends EntryController {

    protected string $entryType = "/debit";

}