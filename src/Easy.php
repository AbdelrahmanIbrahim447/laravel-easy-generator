<?php


namespace biscuit\easyGenerator;

use Illuminate\Support\Facades\File;

class Easy extends Inputs
{
    use MigrationsTrait;
    public function getStub($stub)
    {
        return is_null(config('easygenerator'))
                ? File::get(__DIR__ . './Stubs/'.$stub.'.stub')
                :File::get(config('easygenerator.stubs_path').$stub.'.stub');
    }
}