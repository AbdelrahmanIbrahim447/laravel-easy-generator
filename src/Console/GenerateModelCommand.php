<?php


namespace biscuit\easyGenerator\Console;


use biscuit\easyGenerator\Facades\Easy;
use Illuminate\Console\Command;

class GenerateModelCommand extends Command
{
    protected $signature = 'easy:model
                            {name : The name of the model.}
                            {--namespace= : The namespace of the model.}';

    protected $description = 'make an easy model';


    public function handle()
    {
        $name = Easy::model($this->argument('name'));

        $namespace = Easy::namespace($this->option('namespace'));

        $collection = [
            'name'          =>  $name,
            'namespace'     =>  $namespace,
        ];

        $content = Easy::getStub('Model');

        $this->buildModel($content,$collection);

        $this->info($name . ' created !');

    }
    protected function buildModel($content,$collection)
    {
        $modelTemplate = str_replace(
            [
                '{{modelName}}',
                '{{namespace}}',
            ],
            [
                $collection['name'],
                $collection['namespace']
            ],
            $content
        );

        file_put_contents("./tests/temp/{$collection['name']}.php", $modelTemplate);
    }
}