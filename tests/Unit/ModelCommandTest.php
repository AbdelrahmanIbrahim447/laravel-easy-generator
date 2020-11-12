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
            '--soft' =>  'false',
            '--namespace' =>  'App',
        ])->expectsOutput('Post created !');

    }
    /** @test */
    public function TestModelGenerateNameOnlyCommand()
    {

        $this->artisan('easy:model',[
            'name'  =>  'post',
        ])->expectsOutput('Post created !');

    }
    /** @test */
    public function TestModelGenerateNameWithSoftCommand()
    {
        $this->artisan('easy:model',[
            'name'  =>  'post',
            '--soft' =>  'false',
        ])->expectsOutput('Post created !');

    }
    /** @test */
    public function TestModelGenerateNameWithNamespaceCommand()
    {
        $this->artisan('easy:model',[
            'name'  =>  'post',
            '--namespace' =>  'App',
        ])->expectsOutput('Post created !');

    }
}