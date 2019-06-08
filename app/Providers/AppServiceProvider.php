<?php

namespace App\Providers;

use DB;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

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
        Schema::defaultStringLength(191);
        // 本番環境(Heroku)でhttpsを強制する
      //  if (App::environment('production')) {
      //      URL::forceScheme('https');
      //  }
    }
}
