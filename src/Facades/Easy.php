<?php


namespace biscuit\easyGenerator\Facades;


use Illuminate\Support\Facades\Facade;

class Easy extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Easy';
    }
}