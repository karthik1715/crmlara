<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind( 'App\Repository\IContactRepository',
        'App\Repository\ContactRepository' );
        $this->app->bind( 'App\Repository\IOrganizationRepository',
        'App\Repository\OrganizationRepository' );
        $this->app->bind( 'App\Repository\ISegmentRepository',
        'App\Repository\SegmentRepository' );
        $this->app->bind( 'App\Repository\ICampaignRepository',
        'App\Repository\CampaignRepository' );
        $this->app->bind( 'App\Repository\ISettingsRepository',
        'App\Repository\SettingsRepository' );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
