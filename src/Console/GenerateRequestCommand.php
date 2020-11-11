<?php


namespace biscuit\easyGenerator\Console;


use biscuit\easyGenerator\Facades\Easy;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateRequestCommand extends Command
{
    protected $signature = 'easy:request
                            {name : The name of the model.}
                            {--namespace= : The namespace of the request.}';

    protected $description = 'make an easy request';


    public function handle()
    {
        $name = Easy::request($this->argument('name'));

        $namespace = Easy::namespace($this->option('namespace'));

        $collection = [
            'name'          =>  $name,
            'namespace'     =>  $namespace,
        ];

        $content = Easy::getStub('Request');

        $this->buildRequest($content,$collection);

        $this->info($name . ' created !');

    }
    protected function buildRequest($content,$collection)
    {
        $modelTemplate = str_replace(
            [
                '{{requestName}}',
                '{{namespace}}',
            ],
            [
                $collection['name'],
                $collection['namespace']
            ],
            $content
        );

        if(is_null(config('easygenerator')))
        {

            file_put_contents(app_path()."/Http/Requests/{$collection['name']}.php", $modelTemplate);
        }else {
            if (!File::exists(config('easygenerator.request_path')))
            {
                File::makeDirectory(config('easygenerator.request_path'), 0777, true, true);
            }
            file_put_contents(config('easygenerator.request_path')."{$collection['name']}.php", $modelTemplate);

        }
    }
}