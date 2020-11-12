<?php


namespace biscuit\easyGenerator\Builders;


use Illuminate\Support\Facades\File;

class ModelBuilder extends Builder
{
    public static function build($content, $collection )
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