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
}