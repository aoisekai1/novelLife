<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    protected $namespaceApi = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapApiNovelListRoutes();

        $this->mapRestApi();
        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }


    /** START CUSTOME ROUTES **/
    protected function mapApiNovelListRoutes()
    {
        Route::prefix('apinovel')  // if you need to specify a route prefix
            ->middleware('api') // specify here your middlewares
            ->namespace($this->namespace) // leave it as is
            ->group(base_path('routes/apinovellive.php'));
    }

    protected function mapRestApi()
    {
        Route::prefix('restapi')  // if you need to specify a route prefix
            ->middleware('api') // specify here your middlewares
            ->namespace($this->namespace) // leave it as is
            ->group(base_path('routes/restapi.php'));
    }
    /** END CUSTOME ROUTES **/

}
