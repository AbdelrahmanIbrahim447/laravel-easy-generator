<?php


namespace biscuit\easyGenerator\Console;


use biscuit\easyGenerator\Builders\ModelBuilder;
use biscuit\easyGenerator\Facades\Easy;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateModelCommand extends Command
{
    protected $signature = 'easy:model
                            {name : The name of the model.}
                            {--soft=false : add soft deletes to model.}
                            {--namespace=App : The namespace of the model.}';

    protected $description = 'make an easy model';


    public function handle()
    {
        $name = Easy::model($this->argument('name'));

        $deletes = Easy::deletes($this->option('soft'));

        $namespace = config('easygenerator.model_namespace')
            ? config('easygenerator.model_namespace')
            : Easy::namespace($this->option('namespace'));

        $collection = [
            'name'          =>  $name,
            'namespace'     =>  $namespace,
            'deletes'       =>  $deletes,
        ];

        $content = Easy::getStub('Model');

        ModelBuilder::build($content, $collection);

        $this->info($name . ' created !');

    }

}