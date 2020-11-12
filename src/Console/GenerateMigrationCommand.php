<?php /** @noinspection PhpMissingParentConstructorInspection */


namespace biscuit\easyGenerator\Console;


use biscuit\easyGenerator\Builders\MigrationBuilder;
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

        MigrationBuilder::build($content,$collection);

        $this->info($name . 'Migration created !');

    }
}