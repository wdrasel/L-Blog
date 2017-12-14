<?php

namespace App\Providers;

use App\Category;
use App\Post;
use App\views\Composers\NavigationComposer;
use Illuminate\Support\ServiceProvider;


class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('layouts.sidebar',NavigationComposer::class);
        view()->composer('blog.index',NavigationComposer::class);
        view()->composer('adminpanel.home.index',NavigationComposer::class);

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
