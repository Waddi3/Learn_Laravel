<?php

namespace App\Providers;

use App\Http\ViewComposer\ActivityComposer;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Blade::component('components.badge', 'badge');
        Blade::component('components.updated', 'updated');
        Blade::component('components.card', 'card');
        Blade::component('components.tags', 'tags');
        Blade::component('components.erorrs', 'errors');
        Blade::component('components.comment-form', 'commentForm');
        Blade::component('components.comment-list', 'commentList');
         // view()->composer('*',  ActivityComposer::class);        This will make date from activity composer available in every single Laravel view that you will create
        view()->composer(['posts.index', 'posts.show'], ActivityComposer::class);
       
        
    }
}
