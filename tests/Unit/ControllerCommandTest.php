<?php

namespace biscuit\package\Unit;


use biscuit\easyGenerator\TestCase;


class ControllerCommandTest extends TestCase
{
    /** @test */
    public function TestControllerGenerateCommand()
    {

        $this->artisan('easy:controller',[
            'name'  =>  'post',
            '--model' =>  'Post',
            '--view'  =>  'admin/post'
        ])->expectsOutput('PostController created !');

    }
    /** @test */
    public function TestControllerGenerateWithNameOnlyCommand()
    {

        $this->artisan('easy:controller',[
            'name'  =>  'post',
        ])->expectsOutput('PostController created !');

    }
    /** @test */
    public function TestControllerGenerateWithModelCommand()
    {

        $this->artisan('easy:controller',[
            'name'  =>  'post',
            '--model' =>  'Post',
        ])->expectsOutput('PostController created !');

    }
    /** @test */
    public function TestControllerGenerateWithViewCommand()
    {

        $this->artisan('easy:controller',[
            'name'  =>  'post',
            '--view'  =>  'admin/post'
        ])->expectsOutput('PostController created !');

    }
}