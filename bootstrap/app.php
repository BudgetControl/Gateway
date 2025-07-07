<?php
// Autoload Composer dependencies
use \Illuminate\Support\Carbon as Date;
use Illuminate\Support\Facades\Facade;

require_once __DIR__ . '/../vendor/autoload.php';

// Set up your application configuration
// Initialize slim application
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Crea un'istanza del gestore del database (Capsule)
$capsule = new \Illuminate\Database\Capsule\Manager();

// Aggiungi la configurazione del database al Capsule
$connections = require_once __DIR__.'/../config/database.php';
$capsule->addConnection($connections['mysql']);

require_once __DIR__ . '/../config/aws-cognito.php';

// Esegui il boot del Capsule
$capsule->bootEloquent();
$capsule->setAsGlobal();

require_once __DIR__ . '/../config/cache.php';

// Set up the logger
require_once __DIR__ . '/../config/logger.php';

// ROUTES CONFIGURATION
$routes = require_once __DIR__ . '/../config/routes.php';

// Set up the Facade application
Facade::setFacadeApplication([
    'log' => $logger,
    'aws-cognito-client' => $awsCognitoClient,
    'date' => new Date(),
    'routes' => $routes,
    'cache' => $cache,
]);
