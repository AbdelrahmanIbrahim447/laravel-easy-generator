<?php


namespace biscuit\easyGenerator;


use biscuit\easyGenerator\Console\GenerateControllerCommand;
use biscuit\easyGenerator\Console\GenerateMigrationCommand;
use biscuit\easyGenerator\Console\GenerateModelCommand;
use biscuit\easyGenerator\Console\GenerateRequestCommand;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class EasyGeneratorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // publish files
        if($this->app->runningInConsole())
        {
            $this->registerPublishing();
        }
        // register facades
        $this->app->singleton('Easy',function($app)
        {
            return new \biscuit\easyGenerator\Easy();
        });
    }

    public function register()
    {
        // register commands
        $this->commands([
            GenerateControllerCommand::class,
            GenerateModelCommand::class,
            GenerateRequestCommand::class,
            GenerateMigrationCommand::class,
        ]);
    }

    protected function registerPublishing()
    {
        $subs_path = config('easygenerator') ? config('easygenerator.stubs_path'): base_path('/resources/views/stubs/');

        $this->publishes([
            __DIR__.'/Config/easygenerator.php' =>  config_path('easygenerator.php'),
        ],'easy-config');

        $this->publishes([
            __DIR__ . '/Stubs/Controller.stub'   =>  $subs_path.'Controller.stub',
            __DIR__ . '/Stubs/Model.stub'        =>  $subs_path.'Model.stub',
            __DIR__ . '/Stubs/Migration.stub'    =>  $subs_path.'Migration.stub',
            __DIR__ . '/Stubs/Request.stub'      =>  $subs_path.'Request.stub',
        ],'easy-stubs');
    }
}