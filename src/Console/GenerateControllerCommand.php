<?php


namespace biscuit\easyGenerator\Console;


use biscuit\easyGenerator\Facades\Easy;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateControllerCommand extends Command
{
    protected $signature = 'easy:controller
                            {name : The name of the Crud.}
                            {--model= : The name of the model related to controller.}
                            {--view= : The name of the view redirected to.}';

    protected $description = 'make an easy CRUD controller';


    public function handle()
    {
        $name = Easy::name($this->argument('name'));

        $model = Easy::model($this->option('model'));

        $plural_model = Easy::plural($this->option('model'));

        $lower_model = Easy::lower_model($this->option('model'));

        $view = Easy::view($this->option('view'));

        $content = File::get($this->getStub());

        $this->buildController($content,$name,$model,$plural_model,$lower_model,$view);

        $this->info($name . ' created !');

    }
    protected function buildController($content,$name,$model,$plural_model,$lower_model,$view)
    {
        $modelTemplate = str_replace(
            [
                '{{name}}',
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{viewName}}',
            ],
            [
                $name,
                $model,
                $plural_model,
                $lower_model,
                $view
            ],
            $content
        );

        file_put_contents("./tests/temp/app/{$name}.php", $modelTemplate);
    }
    protected function getStub()
    {
        return __DIR__ . '/../Stubs/Controller.stub';
    }
}