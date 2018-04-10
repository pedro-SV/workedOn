<?php

namespace App\Providers;

use chobie\Jira\Api;
use chobie\Jira\Api\Authentication\Basic;
use chobie\Jira\Issues\Walker;
use Illuminate\Support\ServiceProvider;

class JiraServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(Api::class, function($app) {

            $username = config('jira.username');
            $password = config('jira.pass');
            $endpoint = config('jira.endpoint');

            return new Api(
                $endpoint,
                new Basic($username, $password)
            );

        });

        $this->app->bind(Walker::class, function($app) {
           return new Walker($app->make(Api::class));
        });
    }
}
