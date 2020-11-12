<?php


namespace biscuit\easyGenerator\Console;


use biscuit\easyGenerator\Builders\RequestBuilder;
use biscuit\easyGenerator\Facades\Easy;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateRequestCommand extends Command
{
    protected $signature = 'easy:request
                            {name : The name of the model.}
                            {--rules= : define rules to validate.}
                            {--namespace= : The namespace of the request.}';

    protected $description = 'make an easy request';


    public function handle()
    {

        $name = Easy::request($this->argument('name'));

        $rules = Easy::rules($this->option('rules'));

        $namespace = Easy::namespace($this->option('namespace'));

        $collection = [
            'name'          =>  $name,
            'namespace'     =>  $namespace,
            'rules'         =>  $rules,
        ];

        $content = Easy::getStub('Request');

        RequestBuilder::build($content,$collection);

        $this->info($name . ' created !');

    }
}