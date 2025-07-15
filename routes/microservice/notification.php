<?php

$app->group('/api', function ($group) {

    $group->post('/notify/email/contact', ['\BudgetControl\Notifications\Http\Controller\NotificationController', 'sendEmail']);
    $group->post('/notify/email/auth/recovery-password', ['\BudgetControl\Notifications\Http\Controller\NotificationController', 'recoveryPassword']);
    $group->post('/notify/email/auth/sign-up', ['\BudgetControl\Notifications\Http\Controller\NotificationController', 'signUp']);
    $group->post('/notify/email/budget/exceeded', ['\BudgetControl\Notifications\Http\Controller\NotificationController', 'budgetExceeded']);
    $group->post('/notify/email/workspace/share', ['\BudgetControl\Notifications\Http\Controller\NotificationController', 'workspaceShare']);

})->add(\Budgetcontrol\Gateway\Http\Middleware\AuthMiddleware::class);