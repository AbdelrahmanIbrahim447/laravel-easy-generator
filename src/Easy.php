<?php


namespace biscuit\easyGenerator;

use Illuminate\Support\Facades\File;

class Easy extends Inputs
{
    use MigrationsTrait;
    public function getStub($stub)
    {
        return File::get(__DIR__ . './Stubs/'.$stub.'.stub');
    }
}