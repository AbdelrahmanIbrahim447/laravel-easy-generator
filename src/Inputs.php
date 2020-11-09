<?php


namespace biscuit\easyGenerator;


use Illuminate\Support\Str;

class Inputs
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
        return  $this->pluralize(2,'post');
    }

    private function pluralize($quantity, $singular, $plural=null) {
        if($quantity==1 || !strlen($singular)) return $singular;
        if($plural!==null) return $plural;

        $last_letter = strtolower($singular[strlen($singular)-1]);
        switch($last_letter) {
            case 'y':
                return substr($singular,0,-1).'ies';
            case 's':
                return $singular.'es';
            default:
                return $singular.'s';
        }
    }
}