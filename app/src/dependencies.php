<?php
/**
 * Define dependencies for the app
 * @author Thomas Breese <thomasjbreese@gmail.com>
 */
$container = $app->getContainer();

// Database
// $container['capsule'] = function($c) {
//     $capsule = new Illuminate\Database\Capsule\Manager;
//     $capsule->addConnection($c['settings']['db']);
//     $capsule->setAsGlobal();
//     return $capsule;
// };

// add Monolog
$container['log'] = function($c) {
    $logger = new \Monolog\Logger($c['settings']['name']);
    $formatter = new \Monolog\Formatter\LineFormatter(\Monolog\Formatter\LineFormatter::SIMPLE_FORMAT, \Monolog\Formatter\LineFormatter::SIMPLE_DATE);
    $formatter->includeStacktraces(true);
    $fileHandler = new \Monolog\Handler\StreamHandler('logs/app.log');
    $fileHandler->setFormatter($formatter);
    $logger->pushHandler($fileHandler);
    return $logger;
};

// 404 page not found handler
$container['notFoundHandler'] = function($c) {
    return new App\Handlers\NotFoundError($c['log']);
};

// 405 method not allowed handler
$container['notAllowedHandler'] = function($c) {
    return new App\Handlers\NotAllowedError($c['log']);
};

// 500 error handler
$container['errorHandler'] = function($c) {
    return new App\Handlers\ServerError($c['log']);
};

/**
 * Attach controllers
 */
$container['SomeNamespace\Controllers\ExampleController'] = function($c) {
    return new SomeNamespace\Controllers\ExampleController($c);
};