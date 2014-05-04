<?php

use Illuminate\Support\ServiceProvider;

class ServiceProviderClass extends ServiceProvider {

    public function register() {
        $this->app->bind('DateClass', function() {
            return new General\DateClass;
        });
    }

}
