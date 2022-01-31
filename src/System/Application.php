<?php

declare(strict_types=1);

namespace Mellanyx\StandaloneContainerRouter\System;

use Mellanyx\StandaloneContainerRouter\System\Container\ContainerFactory;
use Mellanyx\StandaloneContainerRouter\System\Router\RouterFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

class Application
{
    public function run(): void
    {
        $container = ContainerFactory::getContainer();
        $router = $container->get(RouterFactory::class);
        $response = $router->dispatch();
        (new SapiEmitter())->emit($response);
    }
}
