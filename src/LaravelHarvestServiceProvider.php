<?php

namespace Byte5\LaravelHarvest;

use Illuminate\Support\ServiceProvider;

class LaravelHarvestServiceProvider extends ServiceProvider
{
    /**
     * Migration Class Names.
     * @var array
     */
    protected $migrationNames = [
        'CreateHarvestClientsTable',
        'CreateHarvestCompaniesTable',
        'CreateHarvestContactsTable',
        'CreateHarvestEstimateItemCategoriesTable',
        'CreateHarvestEstimateMessagesTable',
        'CreateHarvestEstimatesTable',
        'CreateHarvestExpenseCategoriesTable',
        'CreateHarvestExpensesTable',
        'CreateHarvestInvoiceItemCategoriesTable',
        'CreateHarvestInvoiceMessagesTable',
        'CreateHarvestInvoicePaymentsTable',
        'CreateHarvestInvoicesTable',
        'CreateHarvestProjectAssignmentsTable',
        'CreateHarvestProjectsTable',
        'CreateHarvestRolesTable',
        'CreateHarvestTaskAssignmentsTable',
        'CreateHarvestTasksTable',
        'CreateHarvestTimeEntriesTable',
        'CreateHarvestUserAssignmentsTable',
        'CreateHarvestUsersTable',
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../config/harvest.php' => config_path('harvest.php'),
        ], 'config');

        $this->publishMigrations();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/harvest.php', 'harvest');

        $this->app->bind('harvest', ApiManager::class);
    }

    /**
     * Publishes Migrations if not already exist.
     */
    protected function publishMigrations()
    {
        collect($this->migrationNames)->each(function ($migrationName) {
            if (! class_exists($migrationName)) {
                $fileName = lcfirst(\Illuminate\Support\Str::snake($migrationName));

                $this->publishes([
                    __DIR__.'/../database/migrations/'.$fileName.'.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_'.$fileName.'.php'),
                ], 'migrations');
            }
        });
    }
}
