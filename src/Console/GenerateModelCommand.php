<?php


namespace biscuit\easyGenerator\Console;


use biscuit\easyGenerator\Facades\Easy;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

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

        $content = File::get($this->getStub());

        $this->buildController($content,$name,$namespace);
        $this->info($name . ' created !');

    }
    protected function buildController($content,$name,$namespace)
    {
        $modelTemplate = str_replace(
            [
                '{{modelName}}',
                '{{namespace}}',
            ],
            [
                $name,
                $namespace
            ],
            $content
        );

        file_put_contents("./tests/temp/{$name}.php", $modelTemplate);
    }
    protected function getStub()
    {
        return __DIR__ . '/../Stubs/Model.stub';
    }
}