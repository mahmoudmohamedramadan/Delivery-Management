<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider {
  /**
   * This namespace is applied to your controller routes.
   *
   * In addition, it is set as the URL generator's root namespace.
   *
   * @var string
   */
  protected $namespace = 'App\Http\Controllers';

  /**
   * The path to the "home" route for your application.
   *
   * @var string
   */
  public const HOME = '/home';

  /**
   * Define your route model bindings, pattern filters, etc.
   *
   * @return void
   */
  public function boot() {
    //

    parent::boot();
  }

  /**
   * Define the routes for the application.
   *
   * @return void
   */
  public function map() {
    $this->mapApiRoutes();

    $this->mapWebRoutes();

    $this->mapAjaxRoutes();

    $this->mapMechanicRoutes();

    $this->mapSearchRoutes();

    $this->mapCollectionRoutes();

    $this->mapMediaLibraryRoutes();
  }

  /**
   * Define the "web" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapWebRoutes() {
    Route::middleware('web')->namespace($this->namespace)
         ->group(base_path('routes/web.php'));
  }

  /**
   * Define the "api" routes for the application.
   *
   * These routes are typically stateless.
   *
   * @return void
   */
  protected function mapApiRoutes() {
    Route::prefix('api')->middleware('api')->namespace($this->namespace)
         ->group(base_path('routes/api.php'));
  }

  protected function mapAjaxRoutes() {
    //middleware('web) this means we will use the middleware of web inside Kernel.php if you want make another middleware  array like web add it inside middlewareGroups then write key of array here instead of web.
    Route::middleware('web')->namespace($this->namespace)
         ->group(base_path('routes/ajax.php'));
  }

  protected function mapMechanicRoutes() {
    Route::middleware('web')->namespace($this->namespace)
         ->group(base_path('routes/mechanic.php'));
  }

  protected function mapSearchRoutes() {
    Route::middleware('web')->namespace($this->namespace)
         ->group(base_path('routes/search.php'));
  }

  protected function mapCollectionRoutes() {
    Route::middleware('web')->namespace($this->namespace)
         ->group(base_path('routes/collection.php'));
  }

  protected function mapMediaLibraryRoutes() {
    Route::middleware('web')->namespace($this->namespace)
         ->group(base_path('routes/media-library.php'));
  }
}
