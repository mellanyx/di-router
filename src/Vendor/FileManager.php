<?php

declare(strict_types=1);

namespace Mellanyx\StandaloneContainerRouter\Vendor;

class FileManager
{
    protected const PATH = '';

    public static function createConstants(): void
    {
        $content = "<?php

declare(strict_types=1);

const DS = DIRECTORY_SEPARATOR;

define('ROOT_PATH', dirname(__DIR__) . DS);

const CONFIG_PATH = ROOT_PATH . 'config' . DS;
";

        file_put_contents(self::PATH . 'constants.php', $content);
    }

    public static function createContainer(): void
    {
        $content = '<?php

declare(strict_types=1);

//use App\Contacts\Controllers\ContactsController;
//use App\Homepage\Controllers\HomepageController;
//use App\System\Auth\Auth;
use Laminas\Diactoros\ServerRequestFactory;
use Psr\Http\Message\ServerRequestInterface;

//use function DI\create;

return [
//    \'auth\'                        => create(Auth::class),
    ServerRequestInterface::class => fn() => ServerRequestFactory::fromGlobals(),
//    HomepageController::class     => DI\autowire()
//        ->constructorParameter(\'auth\', function () {
//            $auth = new Auth();
//            $auth->setUser([\'username\' => \'Василий\']);
//            return $auth;
//        }),
//    ContactsController::class     => DI\autowire()
//        ->constructorParameter(\'auth\', function () {
//            $auth = new Auth();
//            $auth->setUser([\'username\' => \'Григорий\']);
//            return $auth;
//        }),
];
';

        file_put_contents(self::PATH . 'containers.php', $content);
    }

    public static function createRoutes(): void
    {
        $content = '<?php

declare(strict_types=1);

//use App\Contacts\Controllers\ContactsController;
//use App\Homepage\Controllers\HomepageController;

return function (League\Route\Router $router) {
//    $router->get(\'/\', [HomepageController::class, \'index\']);
//    $router->get(\'/contacts\', [ContactsController::class, \'index\']);
};
';

        file_put_contents(self::PATH . 'routes.php', $content);
    }
}
