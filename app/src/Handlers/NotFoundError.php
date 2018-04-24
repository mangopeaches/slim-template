<?php
namespace App\Handlers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Monolog\Logger;
use Slim\Handlers\Error as SlimError;
use Exception;

/**
 * 404 Handler.
 * @author Thomas Breese <thomasjbreese@gmail.com>
 */
final class NotFoundError extends SlimError
{
	/**
	 * Instance of the logger
	 * @var Logger
	 */
	protected $logger;

	/**
	 * Instantiate a new instance.
	 * @param Logger $logger
	 */
	public function __construct(Logger $logger)
	{
		$this->logger = $logger;
	}

	/**
	 * Invoked when a 404 is encountered.
	 * @param Request $request
	 * @param Response $reponse
	 * @param Exception $exception
	 * @return JSON
	 */
	public function __invoke(Request $request, Response $response)
	{
		$this->logger->error('NotFoundError', [
			'requested url' => $request->getUri(),
			'request method' => $request->getMethod()
		]);
		return $response->withStatus(404)->withJson(['notFound' => 'The requested route does not exist.']);
	}
}
