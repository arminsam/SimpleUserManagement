<?php namespace ASM\Foundation;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Laracasts\Commander\DefaultCommandBus;

class ASMServiceProvider extends ServiceProvider {

    /**
     * register all application service providers
     */
    public function register()
    {
        $this->registerRepositoryService();
        $this->registerDevelopmentEnvironmentServices();
        $this->registerExternalServices();
    }

    /**
     * register WORX repositories service providers
     */
    private function registerRepositoryService()
    {
        $this->app->bind('ASM\Contexts\Capabilities\Repository\CapabilityRepositoryInterface', 'ASM\Contexts\Capabilities\Repository\CapabilityRepository');
        $this->app->bind('ASM\Contexts\Roles\Repository\RoleRepositoryInterface', 'ASM\Contexts\Roles\Repository\RoleRepository');
        $this->app->bind('ASM\Contexts\Users\Repository\UserRepositoryInterface', 'ASM\Contexts\Users\Repository\UserRepository');
    }

    /**
     * register service providers that only run on development environment
     */
    private function registerDevelopmentEnvironmentServices()
    {
        if ($this->app->environment() == 'local')
        {
            $this->app->register('Barryvdh\Debugbar\ServiceProvider');
            $loader = AliasLoader::getInstance();
            $loader->alias('Debugbar', 'Barryvdh\Debugbar\Facade');
        }
    }

    /**
     * register WORX external service providers
     */
    private function registerExternalServices()
    {
        $this->app->bind('Laracasts\Commander\CommandTranslator', 'ASM\Foundation\ASMCommandTranslator');
        $this->app->bind('Laracasts\Commander\CommandBus', function ($app)
        {
            $translator = $app->make('Laracasts\Commander\CommandTranslator');

            return new DefaultCommandBus($app, $translator);
        });
    }

}