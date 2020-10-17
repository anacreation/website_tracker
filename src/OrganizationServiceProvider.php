<?php

namespace Anacreation\Organization;


use Anacreation\Organization\Entities\Entity;
use Anacreation\Organization\Entities\Organization;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class OrganizationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->mergeConfigFrom(
            __DIR__.'/../config/organization.php',
            'organization'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->publishes([
                             __DIR__.'/../config/organization.php' => config_path('organization.php'),
                         ]);
        $this->registerModelFactory();
        $this->resolveRelation();
    }

    private function registerModelFactory() {
        if( !App::environment('production')) {
            $this->app->make(Factory::class)->load(__DIR__.'/../database/factories');
        }
    }

    private function resolveRelation() {
        foreach(config('organization.entities') as $entity => $className) {
            Organization::resolveRelationUsing($entity,
                fn($organizationModel) => $organizationModel->morphedByMany($className,
                                                                            'entity',
                                                                            'entity_organization')
                                                            ->withPivot('include_sub_org')
                                                            ->as('entity')
                                                            ->using(Entity::class));

        }
    }
}
