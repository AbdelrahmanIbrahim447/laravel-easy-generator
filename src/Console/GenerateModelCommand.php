<?php


namespace biscuit\easyGenerator\Console;


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

        if(config('easygenerator.model_namespace'))
        {
            $namespace = config('easygenerator.model_namespace');
        }else{
            $namespace = Easy::namespace($this->option('namespace'));
        }

        $collection = [
            'name'          =>  $name,
            'namespace'     =>  $namespace,
            'deletes'       =>  $deletes,
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
                '{{soft-deletes}}',
            ],
            [
                $collection['name'],
                $collection['namespace'],
                $collection['deletes']
            ],
            $content
        );
        if(is_null(config('easygenerator')))
        {
            file_put_contents(app_path()."{$collection['name']}.php", $modelTemplate);
        }else{
            if (!File::exists(config('easygenerator.model_path')))
            {
                File::makeDirectory(config('easygenerator.model_path'), 0777, true, true);
            }
            file_put_contents(config('easygenerator.model_path')."{$collection['name']}.php", $modelTemplate);

        }
    }
}