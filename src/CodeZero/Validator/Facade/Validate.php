<?php namespace CodeZero\Validator\Facade;

use Illuminate\Support\Facades\Facade;

class Validate extends Facade {

    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'validate';
    }

}