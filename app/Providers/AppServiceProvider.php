<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        //One word validation
        Validator::extend('single_word', function ($attribute, $value, $parameters, $validator) {
            return is_string($value) && ! preg_match('/\s/u', $value);
        }, ":attribute must be single word.");
    }
}