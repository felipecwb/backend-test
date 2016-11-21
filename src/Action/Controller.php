<?php

namespace Felipecwb\Catho\Action;

use Felipecwb\Catho\Application;

abstract class Controller
{
    /**
     * @var Application
     */
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function getApp()
    {
        return $this->app;
    }

    /**
     * @return \Twig_Environment
     */
    public function getTwig()
    {
        return $this->app['twig'];
    }

    /**
     * @return \Doctrine\Common\Cache\MemcachedCache
     */
    public function getCache()
    {
        return $this->app['cache'];
    }
}
