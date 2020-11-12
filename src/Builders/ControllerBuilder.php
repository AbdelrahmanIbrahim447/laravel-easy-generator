<?php


namespace biscuit\easyGenerator\Builders;


use Illuminate\Support\Facades\File;

class ControllerBuilder extends Builder
{
    public static function build($content, $collection )
    {
        $modelTemplate = str_replace(
            [
                '{{name}}',
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{viewName}}',
                '{{namespace}}',
                '{{controllerExtends}}',
            ],
            [
                $collection['name'],
                $collection['model'],
                $collection['plural_model'],
                $collection['lower_model'],
                $collection['view'],
                $collection['namespace'],
                $collection['controllerExtends'],
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