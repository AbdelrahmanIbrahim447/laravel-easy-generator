<?php


namespace biscuit\easyGenerator\Console;


use biscuit\easyGenerator\Facades\Easy;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

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

        $content = Easy::getStub('Request');

        $this->buildRequesst($content,$name,$namespace);

        $this->info($name . ' created !');

    }
    protected function buildRequesst($content,$name,$namespace)
    {
        $modelTemplate = str_replace(
            [
                '{{requestName}}',
                '{{namespace}}',
            ],
            [
                $name,
                $namespace
            ],
            $content
        );

        file_put_contents("./tests/temp/requests/{$name}.php", $modelTemplate);
    }
    protected function getStub()
    {
        return __DIR__ . '/../Stubs/Request.stub';
    }
}