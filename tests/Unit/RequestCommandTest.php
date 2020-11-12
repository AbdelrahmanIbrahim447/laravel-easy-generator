<?php

namespace biscuit\package\Unit;


use biscuit\easyGenerator\TestCase;


class RequestCommandTest extends TestCase
{
    /** @test */
    public function TestRequestGenerateCommand()
    {

        $this->artisan('easy:request',[
            'name'  =>  'post',
            '--rules'  =>  'title#required#max:2#min:2#unique:users,id|description#required#string',
            '--namespace' =>  'App\\Http\\Requests',
        ])->expectsOutput('PostRequest created !');

    }
    /** @test */
    public function TestRequestGenerateWithNameOnlyCommand()
    {

        $this->artisan('easy:request',[
            'name'  =>  'post',
        ])->expectsOutput('PostRequest created !');

    }
    /** @test */
    public function TestRequestGenerateWithRuleCommand()
    {

        $this->artisan('easy:request',[
            'name'  =>  'post',
            '--rules'  =>  'title#required#max:2#min:2#unique:users,id|description#required#string',
        ])->expectsOutput('PostRequest created !');

    }
    /** @test */
    public function TestRequestGenerateWithNamespaceCommand()
    {

        $this->artisan('easy:request',[
            'name'  =>  'post',
            '--namespace' =>  'App\\Http\\Requests',
        ])->expectsOutput('PostRequest created !');

    }
}