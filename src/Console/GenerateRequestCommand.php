<?php


namespace biscuit\easyGenerator\Console;


use biscuit\easyGenerator\Facades\Easy;
use Illuminate\Console\Command;

class GenerateRequestCommand extends Command
{
    protected $signature = 'easy:request
                            {name : The name of the model.}
                            {--namespace= : The namespace of the model.}';

    protected $description = 'make an easy model';


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

        file_put_contents("./tests/temp/requests/{$collection['name']}.php", $modelTemplate);
    }
    protected function getStub()
    {
        return __DIR__ . '/../Stubs/Request.stub';
    }
}