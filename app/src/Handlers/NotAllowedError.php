<?php
namespace App\Handlers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Monolog\Logger;
use Slim\Handlers\Error as SlimError;
use Exception;

/**
 * 405 Handler.
 * @author Thomas Breese <thomasjbreese@gmail.com>
 */
final class NotAllowedError extends SlimError
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
	 * Invoked when a 405 is encountered.
	 * @param Request $request
	 * @param Response $reponse
	 * @param Exception $exception
	 * @return JSON
	 */
	public function __invoke(Request $request, Response $response)
	{
		$this->logger->error('MethodNotAllowedError', [
			'requested url' => $request->getUri(),
			'request method' => $request->getMethod()
		]);
		return $response->withStatus(405)->withJson(['methodNotAllowed' => 'This method is not supported for this resource.']);
	}
}
