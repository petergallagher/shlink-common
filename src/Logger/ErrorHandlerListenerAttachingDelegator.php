<?php

declare(strict_types=1);

namespace Shlinkio\Shlink\Common\Logger;

use Psr\Container\ContainerInterface;
use Zend\ProblemDetails\ProblemDetailsMiddleware;
use Zend\Stratigility\Middleware\ErrorHandler;

class ErrorHandlerListenerAttachingDelegator
{
    /**
     * @return ErrorHandler|ProblemDetailsMiddleware
     */
    public function __invoke(ContainerInterface $container, string $name, callable $callback)
    {
        /** @var ErrorHandler|ProblemDetailsMiddleware $instance */
        $instance = $callback();
        $listeners = $container->get('config')['error_handler']['listeners'] ?? [];
        foreach ($listeners as $listener) {
            $instance->attachListener($container->get($listener));
        }

        return $instance;
    }
}
