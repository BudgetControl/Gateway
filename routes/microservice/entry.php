<?php

$app->group('/api', function ($group) {

    $group->get('/entry/expense', [\Budgetcontrol\Gateway\Http\Controllers\ExpensesController::class, 'list']);
    $group->get('/entry/expense/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\EntryController::class, 'show']);
    $group->get('/entry/income', [\Budgetcontrol\Gateway\Http\Controllers\IncomingController::class, 'list']);
    $group->get('/entry/income/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\EntryController::class, 'show']);
    $group->get('/entry/transfer', [\Budgetcontrol\Gateway\Http\Controllers\TransferController::class, 'list']);
    $group->get('/entry/transfer/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\EntryController::class, 'show']);
    $group->get('/entry/debit', [\Budgetcontrol\Gateway\Http\Controllers\PayeeController::class, 'list']);
    $group->get('/entry/debit/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\EntryController::class, 'show']);
    $group->get('/entry/{goalUuid}/saving', [\Budgetcontrol\Gateway\Http\Controllers\SavingController::class, 'listAll']);
    $group->get('/entry/saving/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\EntryController::class, 'show']);

    // MODEL
    $group->get('/entry/model', [\Budgetcontrol\Gateway\Http\Controllers\EntryModelController::class, 'list']);
    $group->get('/entry/model/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\EntryModelController::class, 'show']);

    // PLANNED ENTRY
    $group->get('/entry/planned', [\Budgetcontrol\Gateway\Http\Controllers\PlannedEntryController::class, 'list']);
    $group->get('/entry/planned/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\PlannedEntryController::class, 'show']);

    // generic ENTRY
    $group->get('/entry/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\EntryController::class, 'show']);
    $group->get('/entry', [\Budgetcontrol\Gateway\Http\Controllers\EntryController::class, 'list']);
})
->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class)
->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware());

$app->group('/api', function($group) {

    $group->put('/entry/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\EntryController::class, 'update']);
    $group->put('/entry/planned/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\PlannedEntryController::class, 'update']);
    $group->post('/entry/planned', [\Budgetcontrol\Gateway\Http\Controllers\PlannedEntryController::class, 'create']);
    $group->put('/entry/model/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\EntryModelController::class, 'update']);
    $group->post('/entry/model', [\Budgetcontrol\Gateway\Http\Controllers\EntryModelController::class, 'create']);
    $group->put('/entry/saving/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\SavingController::class, 'update']);
    $group->post('/entry/saving', [\Budgetcontrol\Gateway\Http\Controllers\SavingController::class, 'create']);
    $group->put('/entry/expense/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\ExpensesController::class, 'update']);
    $group->post('/entry/income', [\Budgetcontrol\Gateway\Http\Controllers\IncomingController::class, 'create']);
    $group->post('/entry/expense', [\Budgetcontrol\Gateway\Http\Controllers\ExpensesController::class, 'create']);
    $group->put('/entry/income/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\IncomingController::class, 'update']);
    $group->post('/entry/transfer', [\Budgetcontrol\Gateway\Http\Controllers\TransferController::class, 'create']);
    $group->put('/entry/transfer/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\TransferController::class, 'update']);
    $group->post('/entry/debit', [\Budgetcontrol\Gateway\Http\Controllers\PayeeController::class, 'create']);
    $group->put('/entry/debit/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\PayeeController::class, 'update']);

    $group->delete('/entry/debit/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\PayeeController::class, 'delete']);
    $group->delete('/entry/income/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\IncomingController::class, 'delete']);
    $group->delete('/entry/expense/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\ExpensesController::class, 'delete']);
    $group->delete('/entry/transfer/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\TransferController::class, 'delete']);
    $group->delete('/entry/saving/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\SavingController::class, 'delete']);
    $group->delete('/entry/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\EntryController::class, 'delete']);
    $group->delete('/entry/model/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\EntryModelController::class, 'delete']);
    $group->delete('/entry/planned/{uuid}', [\Budgetcontrol\Gateway\Http\Controllers\PlannedEntryController::class, 'delete']);
})
->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class)
->add(\Budgetcontrol\Gateway\Http\Middleware\CacheInvalidationMiddleware::class);