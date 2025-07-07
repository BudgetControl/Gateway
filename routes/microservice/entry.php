<?php

$app->group('/api', function ($group) {

    $group->get('/entry/expense', '\Budgetcontrol\Gateway\Http\Controllers\ExpensesController@list');
    $group->get('/entry/expense/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\EntryController@show');
    $group->post('/entry/expense', '\Budgetcontrol\Gateway\Http\Controllers\ExpensesController@create');
    $group->put('/entry/expense/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\ExpensesController@update');

    $group->get('/entry/income', '\Budgetcontrol\Gateway\Http\Controllers\IncomingController@list');
    $group->get('/entry/income/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\EntryController@show');
    $group->post('/entry/income', '\Budgetcontrol\Gateway\Http\Controllers\IncomingController@create');
    $group->put('/entry/income/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\IncomingController@update');

    $group->get('/entry/transfer', '\Budgetcontrol\Gateway\Http\Controllers\TransferController@list');
    $group->get('/entry/transfer/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\EntryController@show');
    $group->post('/entry/transfer', '\Budgetcontrol\Gateway\Http\Controllers\TransferController@create');
    $group->put('/entry/transfer/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\TransferController@update');

    $group->get('/entry/debit', '\Budgetcontrol\Gateway\Http\Controllers\PayeeController@list');
    $group->get('/entry/debit/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\EntryController@show');
    $group->post('/entry/debit', '\Budgetcontrol\Gateway\Http\Controllers\PayeeController@create');
    $group->put('/entry/debit/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\PayeeController@update');

    $group->get('/entry/{goalUuid}/saving', '\Budgetcontrol\Gateway\Http\Controllers\SavingController@listAll');
    $group->get('/entry/saving/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\EntryController@show');
    $group->post('/entry/saving', '\Budgetcontrol\Gateway\Http\Controllers\SavingController@create');
    $group->put('/entry/saving/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\SavingController@update');

    $group->delete('/entry/debit/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\PayeeController@delete');
    $group->delete('/entry/income/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\IncomingController@delete');
    $group->delete('/entry/expense/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\ExpensesController@delete');
    $group->delete('/entry/transfer/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\TransferController@delete');
    $group->delete('/entry/saving/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\SavingController@delete');
    $group->delete('/entry/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\EntryController@delete');
    $group->delete('/entry/model/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\EntryModelController@delete');

    // MODEL
    $group->get('/entry/model', '\Budgetcontrol\Gateway\Http\Controllers\EntryModelController@list');
    $group->post('/entry/model', '\Budgetcontrol\Gateway\Http\Controllers\EntryModelController@create');
    $group->get('/entry/model/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\EntryModelController@show');
    $group->put('/entry/model/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\EntryModelController@update');

    // PLANNED ENTRY
    $group->get('/entry/planned', '\Budgetcontrol\Gateway\Http\Controllers\PlannedEntryController@list');
    $group->post('/entry/planned', '\Budgetcontrol\Gateway\Http\Controllers\PlannedEntryController@create');
    $group->get('/entry/planned/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\PlannedEntryController@show');
    $group->put('/entry/planned/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\PlannedEntryController@update');
    $group->delete('/entry/planned/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\PlannedEntryController@delete');

    // generic ENTRY
    $group->get('/entry/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\EntryController@show');
    $group->put('/entry/{uuid}', '\Budgetcontrol\Gateway\Http\Controllers\EntryController@update');
    $group->get('/entry', '\Budgetcontrol\Gateway\Http\Controllers\EntryController@list');
})->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class);