<?php


namespace biscuit\easyGenerator\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @method static migrationDeletes(array|bool|string|null $option)
 * @method static migrationDate(array|bool|string|null $option)
 * @method static foreign(array|bool|string|null $option)
 * @method static dataFields()
 * @method static migrationFields(array|string|null $argument)
 * @method static migrationClassName($name)
 * @method static getStub(string $string)
 * @method static plural(array|string|null $argument)
 */
class Easy extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Easy';
    }
}