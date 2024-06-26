<?php 
// Path: config/routes.php

return [
    'core' => env('CORE_API_BASE_URL'),
    'workspace' => env('WORKSPACE_API_BASE_URL'),
    'auth' => env('AUTH_API_BASE_URL'),
    'stats' => env('STATS_API_BASE_URL'),
    'budget' => env('BUDGETS_API_BASE_URL'),
    'searchengine' => env('SEARCH_ENGINE_API_BASE_URL'),
];