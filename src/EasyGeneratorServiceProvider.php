<?php


namespace biscuit\easyGenerator;


use biscuit\easyGenerator\Console\GenerateControllerCommand;
use biscuit\easyGenerator\Console\GenerateMigrationCommand;
use biscuit\easyGenerator\Console\GenerateModelCommand;
use biscuit\easyGenerator\Console\GenerateRequestCommand;
use Illuminate\Support\ServiceProvider;

class EasyGeneratorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->singleton('Easy',function($app)
        {
            return new \biscuit\easyGenerator\Easy();
        });
    }

    public function register()
    {
        $this->commands([
            GenerateControllerCommand::class,
            GenerateModelCommand::class,
            GenerateRequestCommand::class,
            GenerateMigrationCommand::class,
        ]);
    }
}