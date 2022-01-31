<?php

declare(strict_types=1);

namespace Mellanyx\StandaloneContainerRouter\System\Container;

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Throwable;

class ContainerFactory
{
    private static ?ContainerInterface $container = null;

    public static function getContainer(): ContainerInterface
    {
        if (! self::$container) {
            try {
                $container = new ContainerBuilder();
                $container->addDefinitions(CONFIG_PATH . 'container.php');
                self::$container = $container->build();
            } catch (Throwable $e) {
                die($e->getMessage());
            }
        }

        return self::$container;
    }
}
