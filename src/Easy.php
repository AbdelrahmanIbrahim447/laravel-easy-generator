<?php


namespace biscuit\easyGenerator;

use biscuit\easyGenerator\Traits\MigrationsTrait;
use biscuit\easyGenerator\Traits\RequestsTrait;
use Illuminate\Support\Facades\File;

class Easy extends Inputs
{
    use MigrationsTrait, RequestsTrait;

    public function getStub($stub)
    {
        return !File::exists(base_path('resources/views/stubs/').$stub.'.stub')
                ? File::get(__DIR__ . './Stubs/'.$stub.'.stub')
                :File::get(config('easygenerator.stubs_path').$stub.'.stub');
    }
}