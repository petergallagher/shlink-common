<?php

declare(strict_types=1);

namespace Shlinkio\Shlink\Common\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;

use function sprintf;

class AccessLogMiddleware implements MiddlewareInterface
{
    public const LOGGER_SERVICE_NAME = self::class . '/Logger';

    public function __construct(private readonly LoggerInterface $logger)
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);
        $this->logger->info(sprintf(
            '%s %s %s %s',
            $request->getMethod(),
            $request->getUri()->getPath(),
            $response->getStatusCode(),
            $response->getHeaderLine('Content-Length'),
        ));

        return $response;
    }
}