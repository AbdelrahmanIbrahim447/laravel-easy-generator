<?php


namespace biscuit\easyGenerator\Console;


use biscuit\easyGenerator\Builders\ControllerBuilder;
use biscuit\easyGenerator\Facades\Easy;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateControllerCommand extends Command
{
    protected $signature = 'easy:controller
                            {name : The name of the Crud.}
                            {--model= : The name of the model related to controller.}
                            {--namespace=App\Http\Controllers : The name of the model related to controller.}
                            {--view= : The name of the view redirected to.}';

    protected $description = 'make an easy CRUD controller';


    public function handle()
    {
        $name = Easy::name($this->argument('name'));

        $model = Easy::model($this->option('model'),$this->argument('name'));

        $plural_model = Easy::plural($this->option('model'),$this->argument('name'));

        $lower_model = Easy::lower_model($this->option('model'),$this->argument('name'));

        $view = Easy::view($this->option('view'),$lower_model);

        $namespace = config('easygenerator.controller_namespace')
                    ? config('easygenerator.controller_namespace')
                    : Easy::namespace($this->option('namespace'));

        $addControllerExtend = $namespace != 'App\\Http\\Controllers' ? 'use App\Http\Controllers\Controller;' : '';

        $collection = [
            'name'                  =>  $name,
            'model'                 =>  $model,
            'plural_model'          =>  $plural_model,
            'lower_model'           =>  $lower_model,
            'view'                  =>  $view,
            'namespace'             =>  $namespace,
            'controllerExtends'     =>  $addControllerExtend
        ];

        $content = Easy::getStub('Controller');

        ControllerBuilder::build($content,$collection);

        $this->info($name . ' created !');

    }
}