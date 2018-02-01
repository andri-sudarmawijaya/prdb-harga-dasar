<?php namespace Bantenprov\PdrbHargaDasar;

use Illuminate\Support\ServiceProvider;
use Bantenprov\PdrbHargaDasar\Console\Commands\PdrbHargaDasarCommand;

/**
 * The PdrbHargaDasarServiceProvider class
 *
 * @package Bantenprov\PdrbHargaDasar
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class PdrbHargaDasarServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Bootstrap handles
        $this->routeHandle();
        $this->configHandle();
        $this->langHandle();
        $this->viewHandle();
        $this->assetHandle();
        $this->migrationHandle();
        $this->publicHandle();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('pdrb-harga-dasar', function ($app) {
            return new PdrbHargaDasar;
        });

        $this->app->singleton('command.pdrb-harga-dasar', function ($app) {
            return new PdrbHargaDasarCommand;
        });

        $this->commands('command.pdrb-harga-dasar');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'pdrb-harga-dasar',
            'command.pdrb-harga-dasar',
        ];
    }

    /**
     * Loading package routes
     *
     * @return void
     */
    protected function routeHandle()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/routes.php');
    }

    /**
     * Loading and publishing package's config
     *
     * @return void
     */
    protected function configHandle()
    {
        $packageConfigPath = __DIR__.'/config/config.php';
        $appConfigPath     = config_path('pdrb-harga-dasar.php');

        $this->mergeConfigFrom($packageConfigPath, 'pdrb-harga-dasar');

        $this->publishes([
            $packageConfigPath => $appConfigPath,
        ], 'config');
    }

    /**
     * Loading and publishing package's translations
     *
     * @return void
     */
    protected function langHandle()
    {
        $packageTranslationsPath = __DIR__.'/resources/lang';

        $this->loadTranslationsFrom($packageTranslationsPath, 'pdrb-harga-dasar');

        $this->publishes([
            $packageTranslationsPath => resource_path('lang/vendor/pdrb-harga-dasar'),
        ], 'lang');
    }

    /**
     * Loading and publishing package's views
     *
     * @return void
     */
    protected function viewHandle()
    {
        $packageViewsPath = __DIR__.'/resources/views';

        $this->loadViewsFrom($packageViewsPath, 'pdrb-harga-dasar');

        $this->publishes([
            $packageViewsPath => resource_path('views/vendor/pdrb-harga-dasar'),
        ], 'views');
    }

    /**
     * Publishing package's assets (JavaScript, CSS, images...)
     *
     * @return void
     */
    protected function assetHandle()
    {
        $packageAssetsPath = __DIR__.'/resources/assets';

        $this->publishes([
            $packageAssetsPath => resource_path('assets'),
        ], 'pdrb-assets');
    }

    /**
     * Publishing package's migrations
     *
     * @return void
     */
    protected function migrationHandle()
    {
        $packageMigrationsPath = __DIR__.'/database/migrations';

        $this->loadMigrationsFrom($packageMigrationsPath);

        $this->publishes([
            $packageMigrationsPath => database_path('migrations')
        ], 'migrations');
    }

    public function publicHandle()
    {
        $packagePublicPath = __DIR__.'/public';

        $this->publishes([
            $packagePublicPath => base_path('public')
        ], 'pdrb-public');
    }
}
