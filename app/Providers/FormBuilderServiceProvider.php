<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FormBuilderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('magazine_form', function ($app) {
            $form = new \App\Html\FormBuilder($app['html'], $app['url'], $app['session.store']->getToken());

            return $form->setSessionStore($app['session.store']);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {


    }
}
