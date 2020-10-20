<?php


namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class JsonPlaceHolder extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'JsonPlaceHolder';
    }
}
