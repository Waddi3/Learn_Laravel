<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
//use Illuminate\Support\Facades\Gates;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Models\BlogPost' => 'App\Policies\BlogPostPolicy',
        'App\Models\User' => 'App\Policies\UsersPolicy',
    ]; 

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('home.secret', function($user){
            return $user->is_admin;
        });

        // Gate::define('update-post', function($user , $post){
        //     return $user->id == $post->user_id;
        // });
        //Gate::allows('update-post', $post);
        
        // Gate::define('delete-post', function($user , $post){
        //     return $user->id == $post->user_id;
        // });

        // Gate::define('posts.update', 'App\policies\BlogPostPolicy@update');

        // Gate::define('posts.delete', 'App\policies\BlogPostPolicy@delete');

       // Gate::resource('posts', 'App\policies\BlogPostPolicy');
        //posts.create , posts.view, posts.update, posts.delete
        Gate::before(function($user , $ability){
            if($user->is_admin && in_array($ability , ['update','delete'])){
                return true;
            }
        
        });
        // Gate::after(function($user, $ability){
        //     if($user->is_admin){
        //         return true;
        //     }
        // });
     }
}
