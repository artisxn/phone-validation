<?php namespace codicastudio\LaravelPhone;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rule;
use libphonenumber\PhoneNumberUtil;
use codicastudio\LaravelPhone\Rules;
use codicastudio\LaravelPhone\Validation;

class PhoneServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('libphonenumber', function ($app) {
            return PhoneNumberUtil::getInstance();
        });

        $this->app->alias('libphonenumber', PhoneNumberUtil::class);
    }
    
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['validator']->extendDependent('phone', Validation\Phone::class . '@validate');

        Rule::macro('phone', function () {
            return new Rules\Phone;
        });
    }
}
