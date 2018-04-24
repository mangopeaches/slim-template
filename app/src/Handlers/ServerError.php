<?php
namespace App\Handlers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Monolog\Logger;
use Slim\Handlers\Error as SlimError;
use Exception;

/**
 * 500 Handler.
 * @author Thomas Breese <thomasjbreese@gmail.com>
 */
final class ServerError extends SlimError
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
	 * Invoked when an exception is encountered.
	 * @param Request $request
	 * @param Response $reponse
	 * @param Exception $exception
	 * @return JSON
	 */
	public function __invoke(Request $request, Response $response, Exception $exception)
	{
		$this->logger->critical($exception);
		return $response->withStatus(500)->withJson(['serverError' => 'Something unexpected happened.']);
	}
}
