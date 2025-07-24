<?php

$app->group('/api', function ($group) {

    $group->post('/notify/email/contact', [\Budgetcontrol\Gateway\Http\Controllers\NotificationController::class, 'sendEmail']);
    $group->post('/notify/email/auth/recovery-password', [\Budgetcontrol\Gateway\Http\Controllers\NotificationController::class, 'recoveryPassword']);
    $group->post('/notify/email/auth/sign-up', [\Budgetcontrol\Gateway\Http\Controllers\NotificationController::class, 'signUp']);
    $group->post('/notify/email/budget/exceeded', [\Budgetcontrol\Gateway\Http\Controllers\NotificationController::class, 'budgetExceeded']);
    $group->post('/notify/email/workspace/share', [\Budgetcontrol\Gateway\Http\Controllers\NotificationController::class, 'workspaceShare']);

    $group->get('/notify/message/last', [\Budgetcontrol\Gateway\Http\Controllers\NotificationController::class, 'lastMessage'])->add(new \Budgetcontrol\Gateway\Http\Middleware\CachingMiddleware(3600));


})->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class);