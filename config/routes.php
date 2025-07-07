<?php 
// Path: config/routes.php

$queryFilters = explode(',', env('QUERY_FILTERS', ''));

return [
    'core' => env('CORE_API_BASE_URL'),
    'workspace' => env('WORKSPACE_API_BASE_URL'),
    'auth' => env('AUTH_API_BASE_URL'),
    'stats' => env('STATS_API_BASE_URL'),
    'budget' => env('BUDGETS_API_BASE_URL'),
    'searchengine' => env('SEARCH_ENGINE_API_BASE_URL'),
    'wallet' => env('WALLET_API_BASE_URL'),
    'entry' => env('ENTRY_API_BASE_URL'),
    'debt' => env('DEBT_API_BASE_URL'),
    'label' => env('LABEL_API_BASE_URL'),
    'savings' => env('SAVINGS_API_BASE_URL'),
    'goals' => env('GOALS_API_BASE_URL'),
];