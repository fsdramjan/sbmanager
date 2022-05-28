<?php

namespace App\Providers;

use App\Models\CompanyInfo;
use Illuminate\Support\Facades\Schema;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('company_infos')) {
            $company = CompanyInfo::find(1);
            view()->share('company', $company);

        };
        Paginator::useBootstrap();
    }
}
