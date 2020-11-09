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
            '--namespace' =>  'App\\Http\\Requests',
        ])->expectsOutput('PostRequest created !');

        $this->assertFileExists('G:\Laravel\easyGenerator\tests\temp\Requests\PostRequest.php');

    }
}