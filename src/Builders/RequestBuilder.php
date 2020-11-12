<?php


namespace biscuit\easyGenerator\Builders;


use Illuminate\Support\Facades\File;

class RequestBuilder extends Builder
{
    public static function build($content, $collection )
    {
        $modelTemplate = str_replace(
            [
                '{{requestName}}',
                '{{namespace}}',
                '{{rules}}',
            ],
            [
                $collection['name'],
                $collection['namespace'],
                $collection['rules']
            ],
            $content
        );

        if(is_null(config('easygenerator')))
        {
            file_put_contents(app_path()."/Http/Requests/{$collection['name']}.php", $modelTemplate);
        }else {
            if (!File::exists(config('easygenerator.request_path')))
            {
                File::makeDirectory(config('easygenerator.request_path'), 0777, true, true);
            }
            file_put_contents(config('easygenerator.request_path')."{$collection['name']}.php", $modelTemplate);

        }
    }
}