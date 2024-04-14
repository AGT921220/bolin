<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DropAllTables extends Command
{
    protected $signature = 'db:dropalltables';
    protected $description = 'Drop all tables in the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        if ($this->confirm('Do you really want to drop all tables? This action is irreversible!', false)) {
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            $tables = DB::select('SHOW TABLES');
            foreach ($tables as $table) {
                $table_array = get_object_vars($table);
                $table_name = array_values($table_array)[0];
                DB::statement('DROP TABLE ' . $table_name);
            }
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
            $this->info('All tables have been dropped');
        }
    }
}
