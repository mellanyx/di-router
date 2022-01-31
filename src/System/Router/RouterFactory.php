<?php

declare(strict_types=1);

namespace Mellanyx\StandaloneContainerRouter\System\Router;

use League\Route\Router;
use League\Route\Strategy\ApplicationStrategy;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

class RouterFactory
{
    protected Router $router;
    protected ServerRequestInterface $serverRequest;
    protected ContainerInterface $container;

    public function __construct(ServerRequestInterface $serverRequest, ContainerInterface $container)
    {
        $this->serverRequest = $serverRequest;
        $this->container = $container;
        $this->router = new Router();
        $this->getRouterConfig();
        $this->setStrategy();
    }

    private function getRouterConfig(): void
    {
        (require CONFIG_PATH . 'routes.php')($this->router);
    }

    private function setStrategy(): void
    {
        try {
            $applicationStrategy = $this->container->get(ApplicationStrategy::class);
            $applicationStrategy->setContainer($this->container);
            $this->router->setStrategy($applicationStrategy);
        } catch (Throwable $exception) {
            die($exception->getMessage());
        }
    }

    public function dispatch(): ResponseInterface
    {
        return $this->router->dispatch($this->serverRequest);
    }
}
