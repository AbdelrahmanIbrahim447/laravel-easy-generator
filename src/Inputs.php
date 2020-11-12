<?php


namespace biscuit\easyGenerator;


use biscuit\easyGenerator\Validators\Validators;
use Illuminate\Support\Str;

class Inputs extends Validators
{
    public function name($name)
    {
        return ucfirst(Str::lower($name)) . 'Controller';
    }

    public function request($name)
    {
        return ucfirst(Str::lower($name)) . 'Request';
    }

    public function model($modelName, $backupname = null)
    {
        return $modelName !== null ? ucfirst(Str::lower($modelName)) : ucfirst(Str::lower($backupname));
    }

    public function lower_model($modelName,$backup)
    {
        return $modelName !== null ? Str::lower($modelName):Str::lower($backup);
    }

    public function view($viewName,$modelName)
    {
        return $viewName !== null ? $viewName : $modelName ;
    }

    public function namespace($namespace)
    {
        return $namespace;
    }

    public function deletes($deletes)
    {
        $data = '';
        if($deletes)
        {
            $data = 'protected $softDelete = true;';
        }
        return $data;
    }

    public function plural($word,$name = null)
    {
        return  $word !== null ? Str::plural($word) : Str::plural($name);
    }

}