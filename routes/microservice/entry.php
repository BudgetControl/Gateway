<?php

$app->group('/api', function ($group) {

    $group->get('/entry/expense', [\Budgetcontrol\Gateway\Http\Controllers\ExpensesController::class, 'list']);
    $group->get('/entry/expense/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\EntryController::class, 'show']);
    $group->post('/entry/expense', [\Budgetcontrol\Gateway\Http\Controllers\ExpensesController::class, 'create']);
    $group->put('/entry/expense/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\ExpensesController::class, 'update']);

    $group->get('/entry/income', [\Budgetcontrol\Gateway\Http\Controllers\IncomingController::class, 'list']);
    $group->get('/entry/income/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\EntryController::class, 'show']);
    $group->post('/entry/income', [\Budgetcontrol\Gateway\Http\Controllers\IncomingController::class, 'create']);
    $group->put('/entry/income/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\IncomingController::class, 'update']);

    $group->get('/entry/transfer', [\Budgetcontrol\Gateway\Http\Controllers\TransferController::class, 'list']);
    $group->get('/entry/transfer/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\EntryController::class, 'show']);
    $group->post('/entry/transfer', [\Budgetcontrol\Gateway\Http\Controllers\TransferController::class, 'create']);
    $group->put('/entry/transfer/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\TransferController::class, 'update']);

    $group->get('/entry/debit', [\Budgetcontrol\Gateway\Http\Controllers\PayeeController::class, 'list']);
    $group->get('/entry/debit/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\EntryController::class, 'show']);
    $group->post('/entry/debit', [\Budgetcontrol\Gateway\Http\Controllers\PayeeController::class, 'create']);
    $group->put('/entry/debit/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\PayeeController::class, 'update']);

    $group->get('/entry/{goalUuid}/saving', [\Budgetcontrol\Gateway\Http\Controllers\SavingController::class, 'listAll']);
    $group->get('/entry/saving/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\EntryController::class, 'show']);
    $group->post('/entry/saving', [\Budgetcontrol\Gateway\Http\Controllers\SavingController::class, 'create']);
    $group->put('/entry/saving/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\SavingController::class, 'update']);

    $group->delete('/entry/debit/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\PayeeController::class, 'delete']);
    $group->delete('/entry/income/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\IncomingController::class, 'delete']);
    $group->delete('/entry/expense/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\ExpensesController::class, 'delete']);
    $group->delete('/entry/transfer/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\TransferController::class, 'delete']);
    $group->delete('/entry/saving/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\SavingController::class, 'delete']);
    $group->delete('/entry/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\EntryController::class, 'delete']);
    $group->delete('/entry/model/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\EntryModelController::class, 'delete']);

    // MODEL
    $group->get('/entry/model', [\Budgetcontrol\Gateway\Http\Controllers\EntryModelController::class, 'list']);
    $group->post('/entry/model', [\Budgetcontrol\Gateway\Http\Controllers\EntryModelController::class, 'create']);
    $group->get('/entry/model/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\EntryModelController::class, 'show']);
    $group->put('/entry/model/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\EntryModelController::class, 'update']);

    // PLANNED ENTRY
    $group->get('/entry/planned', [\Budgetcontrol\Gateway\Http\Controllers\PlannedEntryController::class, 'list']);
    $group->post('/entry/planned', [\Budgetcontrol\Gateway\Http\Controllers\PlannedEntryController::class, 'create']);
    $group->get('/entry/planned/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\PlannedEntryController::class, 'show']);
    $group->put('/entry/planned/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\PlannedEntryController::class, 'update']);
    $group->delete('/entry/planned/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\PlannedEntryController::class, 'delete']);

    // generic ENTRY
    $group->get('/entry/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\EntryController::class, 'show']);
    $group->put('/entry/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\EntryController::class, 'update']);
    $group->get('/entry', [\Budgetcontrol\Gateway\Http\Controllers\EntryController::class, 'list']);
})->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class);