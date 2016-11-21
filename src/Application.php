<?php
namespace Felipecwb\Catho;

use Silex\Application as BaseApplication;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Memcached;
use Doctrine\Common\Cache\MemcachedCache;

class Application extends BaseApplication
{
    public function __construct(array $values = array())
    {
        parent::__construct($values);

        // config
        $configs = require $this['directory.base'] . '/app/config.php';
        foreach ($configs as $key => $value) {
            $this[$key] = $value;
        }

        // cache
        $this['cache'] = function () {
            $memcached = new Memcached();
            $memcached->addServer(
                $this['info.memcached']['host'],
                $this['info.memcached']['port']
            );

            $cacheDriver = new MemcachedCache();
            $cacheDriver->setMemcached($memcached);

            return $cacheDriver;
        };

        // providers
        $this->register(new ServiceControllerServiceProvider());
        $this->register(new TwigServiceProvider(), array(
            'twig.path' => $this['directory.base'] . '/views',
        ));

        $this->registerJsonRequestBody();
        $this->registerRoutes();
    }

    private function registerJsonRequestBody()
    {
        $this->before(function (Request $request) {
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $request->request->replace(is_array($data) ? $data : array());
            }
        });
    }

    public function addController($httpClass)
    {
        $alias = 'controller.' . str_replace(['\\', 'Controller'], ['.', ''], lcfirst($httpClass));
        $httpClass = 'Felipecwb\\Catho\\Action\\' . $httpClass;

        $this[$alias] = function () use ($httpClass) {
            return new $httpClass($this);
        };
    }

    private function registerRoutes()
    {
        $configs = require $this['directory.base'] . '/app/routes.php';
    }
}
