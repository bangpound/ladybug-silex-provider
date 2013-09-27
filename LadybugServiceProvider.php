<?php

namespace Bangpound\Silex;

use Ladybug\Dumper;
use Silex\Application;
use Silex\ServiceProviderInterface;

class LadybugServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Application $app An Application instance
     */
    public function register(Application $app)
    {
        $app['ladybug.dumper'] = $app->share(function () use ($app) {
            return new Dumper();
        });

        $app['twig'] = $app->share($app->extend('twig', function (\Twig_Environment $twig, $app) {
            $twig->addExtension(new LadybugExtension($app));

            return $twig;
        }));
    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registered
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     */
    public function boot(Application $app)
    {
        // TODO: Implement boot() method.
    }
}
