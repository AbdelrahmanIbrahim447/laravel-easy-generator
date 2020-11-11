<?php

namespace biscuit\package\Unit;


use biscuit\easyGenerator\TestCase;


class MigrationCommandTest extends TestCase
{
    /** @test */
    public function TestMigrationGenerateCommand()
    {

        $this->artisan('easy:migration',[
            'model'             =>  'post',
            'fields'            =>  'active:enum,1,2#comment->1 for active,2 for inactive#default->1#nullable|title:string#comment->titleComment#nullable|filter:filtered|body:text|image:text|visitors:integer#nullable|user_id:integer#unsigned',
            '--foreign'         =>  'users_id|id|users#comment_id|id|comments',
            '--soft-deletes'    =>  'true',
            '--dates'           =>  'true'

        ])->expectsOutput('postsMigration created !');

    }
}