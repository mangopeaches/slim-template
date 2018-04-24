<?php
/**
 * Configure routes available to the application
 * @author Thomas Breese <thomasjbreese@gmail.com>
 */

/**
 * Define app routes
 */
$app->get('/', function($request, $response, $params) use ($container) {
	$this->log->addInfo('Hit the hello world route!');
	return $response->getBody()->write('Hello, world!');
});
