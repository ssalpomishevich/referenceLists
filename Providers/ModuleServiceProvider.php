<?php namespace Larapage\Modules\ReferenceLists\Providers;

use Larapage\Modules\ReferenceLists\Models\Department;
use Larapage\Modules\ReferenceLists\Models\Specialization;
use Larapage\System\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    /**
     * Register any application authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'referenceLists');

        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'lp.modules.public.referenceLists'
        );

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'referenceLists');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        /*
        |--------------------------------------------------------------------------
        | Top nav view composers.
        |--------------------------------------------------------------------------
        */
        $this->app->view->composer('system::_partials.topNav', 'Larapage\Modules\ReferenceLists\Composers\TopNavViewComposer');


        /*
        |--------------------------------------------------------------------------
        | Register route service provider
        |--------------------------------------------------------------------------
        */
        $this->app->register('Larapage\Modules\ReferenceLists\Providers\RouteServiceProvider');


        /*
        |--------------------------------------------------------------------------
        | Bind repository interfaces
        |--------------------------------------------------------------------------
        */

        // Department repo
        $this->app->bind('Larapage\Modules\ReferenceLists\Repositories\Departments\DepartmentInterface', function () {
            $eloquentModel = 'Larapage\ReferenceLists\Repositories\Departments\EloquentDepartment';
            $repository = new $eloquentModel(new Department);

            if(!config('larapage.cache')) return $repository;

            return new \Larapage\Modules\ReferenceLists\Repositories\Departments\CacheDecorator($repository, $this->app['cache']);
        });

        // Specialization repo
        $this->app->bind('Larapage\Modules\ReferenceLists\Repositories\Specializations\SpecializationInterface', function () {
            $eloquentModel = 'Larapage\ReferenceLists\Repositories\Specializations\EloquentSpecialization';
            $repository = new $eloquentModel(new Specialization);

            if(!config('larapage.cache')) return $repository;
            return new \Larapage\Modules\ReferenceLists\Repositories\Specializations\CacheDecorator($repository, $this->app['cache']);
        });

    }


}
