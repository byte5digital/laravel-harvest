<?php

namespace Byte5\LaravelHarvest\Test\Feature\Transformer;

trait MigrationSetup
{
    protected function setUp()
    {
        parent::setUp();

        $tableName = $this->getTableName();
        $tableClass = '\CreateHarvest'.$tableName.'Table';

        include_once __DIR__.'/../../../database/migrations/create_harvest_'.snake_case($tableName).'_table.php.stub';
        (new $tableClass)->up();
    }

    private function getTableName()
    {
        return str_plural(str_after(str_before(class_basename(self::class), 'Test'), 'Transform'));
    }
}