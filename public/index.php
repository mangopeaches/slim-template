<?php
/**
 * Main entry point for the application
 * @author Thomas Breese <thomasjbreese@gmail.com>
 */
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

// All file paths relative to root
chdir(dirname(__DIR__));

require 'vendor/autoload.php';

// load the global or local config, depending which is present
if (file_exists('app/src/settings.php')) {
    $settings = require 'app/src/settings.php';
} else {
    $settings = require 'app/settings.php.dist';
}

// Instantiate Slim
$app = new \Slim\App($settings);

require 'app/src/dependencies.php';
require 'app/src/middleware.php';

// Register the routes
require 'app/src/routes.php';

// Register the database connection with Eloquent
// $capsule = $app->getContainer()->get('capsule');
// $capsule->bootEloquent();

$app->run();
