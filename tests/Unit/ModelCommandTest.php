<?php

namespace biscuit\package\Unit;


use biscuit\easyGenerator\TestCase;


class ModelCommandTest extends TestCase
{
    /** @test */
    public function TestModelGenerateCommand()
    {

        $this->artisan('easy:model',[
            'name'  =>  'post',
            '--namespace' =>  'App',
        ])->expectsOutput('Post created !');

    }
}