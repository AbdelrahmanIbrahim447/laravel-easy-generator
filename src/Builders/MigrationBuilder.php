<?php


namespace biscuit\easyGenerator\Builders;


use Illuminate\Support\Facades\File;

class MigrationBuilder extends Builder
{
    /**
     * @var false|string
     */
    private static $date;
    public function __construct()
    {
        self::$date = date('Y_m_d_His');
    }

    public static function build($content, $collection )
    {
        $modelTemplate = str_replace(
            [
                '{{className}}',
                '{{tableName}}',
                '{{fields}}',
                '{{foreign}}',
                '{{soft-deletes}}',
                '{{dates}}',
            ],
            [
                $collection['className'],
                $collection['name'],
                $collection['fields'],
                $collection['foreign'],
                $collection['deletes'],
                $collection['dates'],
            ],
            $content
        );
        if (!File::exists(base_path('database/migrations/')))
        {
            File::makeDirectory(base_path('database/migrations/'), 0777, true, true);
        }
        file_put_contents(base_path('database/migrations/'). self::$date . '_create_' . $collection['name'] . '_table.php', $modelTemplate);

    }
}