<?php


namespace biscuit\easyGenerator;

use Illuminate\Support\Facades\File;

class Easy extends Inputs
{
    public function getStub($stub)
    {
        return File::get(__DIR__ . './Stubs/'.$stub.'.stub');
    }
}