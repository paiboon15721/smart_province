<?php

use Illuminate\Support\Facades\Facade;

class DateClass extends Facade {

    protected static function getFacadeAccessor() {
        return 'DateClass';
    }

}
