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

        $model = Easy::model($this->option('model'),$this->argument('name'));

        $plural_model = Easy::plural($this->option('model'),$this->argument('name'));

        $lower_model = Easy::lower_model($this->option('model'),$this->argument('name'));

        $view = Easy::view($this->option('view'),$lower_model);

        $collection = [
            'name'          =>  $name,
            'model'         =>  $model,
            'plural_model'  =>  $plural_model,
            'lower_model'   =>  $lower_model,
            'view'          =>  $view
        ];
        $content = Easy::getStub('Controller');

        $this->buildController($content,$collection);

        $this->info($name . ' created !');

    }
    protected function buildController($content,$collection)
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
                $collection['name'],
                $collection['model'],
                $collection['plural_model'],
                $collection['lower_model'],
                $collection['view'],
            ],
            $content
        );
        if(is_null(config('easygenerator')))
        {
            if (!File::exists(app_path('/Http/Requests/')))
            {
                File::makeDirectory(app_path('/Http/Requests/'), 0777, true, true);
            }

            file_put_contents(app_path('/Http/Requests/') ."{$collection['name']}.php", $modelTemplate);
        }else{
            if (!File::exists(config('easygenerator.controller_path')))
            {
                File::makeDirectory(config('easygenerator.controller_path'), 0777, true, true);
            }
            file_put_contents(config('easygenerator.controller_path')."{$collection['name']}.php", $modelTemplate);

        }
    }
}