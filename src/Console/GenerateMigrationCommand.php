<?php /** @noinspection PhpMissingParentConstructorInspection */


namespace biscuit\easyGenerator\Console;


use biscuit\easyGenerator\Facades\Easy;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateMigrationCommand extends Command
{
    protected $signature = 'easy:migration
                            {model : The name of the model.}
                            {fields : Fields with : type separated by pipe | .}
                            {--foreign= : foreign key with foreign_entity then entity then table , eg:user_id|id|user.}
                            {--soft-deletes= : true or false .}
                            {--dates=true : true or false .}';

    protected $description = 'make an easy migration file';

    protected $date;

    public function __construct()
    {
        parent::__construct();
        $this->date = date('Y_m_d_His');

    }

    public function handle()
    {
        $name = Easy::plural($this->argument('model'));

        $content = Easy::getStub('Migration');

        $className = Easy::migrationClassName($name);

        $fields = Easy::migrationFields($this->argument('fields'));

        $data = Easy::dataFields();

        $foreignKeys = Easy::foreign($this->option('foreign'));

        $dates = Easy::migrationDate($this->option('dates'));

        $deletes = Easy::migrationDeletes($this->option('soft-deletes'));

        $collection = [
          'className'   =>  $className,
          'name'        =>  $name,
          'fields'      =>  $data,
          'foreign'     =>  $foreignKeys,
          'deletes'     =>  $deletes,
          'dates'       =>  $dates,
        ];

        $this->buildModel($content,$collection);

        $this->info($name . 'Migration created !');

    }
    protected function buildModel($content,$collection)
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
        file_put_contents(base_path('database/migrations/').$this->date . '_create_' . $collection['name'] . '_table.php', $modelTemplate);
    }
}