<?php


namespace biscuit\easyGenerator;


use Illuminate\Support\Str;

class Inputs extends Validators
{
    public function name(string $name) : string
    {
        return ucfirst(Str::lower($name)) . 'Controller';
    }

    public function request(string $name) :string
    {
        return ucfirst(Str::lower($name)) . 'Request';
    }

    public function model(string $modelName) :string
    {
        return ucfirst(Str::lower($modelName));
    }

    public function lower_model(string $modelName) :string
    {
        return Str::lower($modelName);
    }

    public function view(string $viewName) :string
    {
        return $viewName;
    }

    public function namespace(string $namespace) :string
    {
        return $namespace;
    }

    public function plural(string $word) : string
    {
        return  Str::plural($word);
    }

}