<?php


namespace biscuit\easyGenerator;


use Illuminate\Support\Str;

class Easy
{
    public function name($name)
    {
        return ucfirst(Str::lower($name)) . 'Controller';
    }
    public function request($name)
    {
        return ucfirst(Str::lower($name)) . 'Request';
    }
    public function model($modelName)
    {
        return ucfirst(Str::lower($modelName));
    }
    public function lower_model($modelName)
    {
        return Str::lower($modelName);
    }
    public function view($viewName)
    {
        return $viewName;
    }
    public function namespace($namespace)
    {
        return $namespace;
    }
    public function plural($word)
    {
        return  $this->pluralize(2,'post');
    }


    /**
     * Pluralizes a word if quantity is not one.
     *
     * @param int $quantity Number of items
     * @param string $singular Singular form of word
     * @param string $plural Plural form of word; function will attempt to deduce plural form from singular if not provided
     * @return string Pluralized word if quantity is not one, otherwise singular
     */
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