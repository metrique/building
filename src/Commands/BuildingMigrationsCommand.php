<?php

namespace Metrique\Building\Commands;

use Illuminate\Console\Command;
use Metrique\Building\Traits\BuildingCommandOutputTrait;

class BuildingMigrationsCommand extends Command
{
    use BuildingCommandOutputTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'metrique:migrate-building';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create metrique/building migration files.';

    /**
     * Path to database migrations in your laravel app.
     *
     * @var string
     */
    protected $migrationPath = 'database/migrations';

    /**
     * List of migrations to be processed in order.
     *
     * @var array
     */
    protected $migrations = [
        'create_building_pages',
        'create_building_page_sections',
        'create_building_page_contents',
        'create_building_page_groups',
        'create_building_blocks',
        'create_building_block_structures',
        'create_building_block_types',
        'fk_building_page_sections',
        'fk_building_page_contents',
        'fk_building_block_structures'
    ];

    /**
     * Track any migration files that are created.
     *
     * @var array
     */
    protected $migrationsOutput = [];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        foreach ($this->migrations as $key => $value) {
            $migration = [
                'view' => 'metrique-building::migrations.' . $value,
                'file' => base_path($this->migrationPath) . '/' . date('Y_m_d_His') . '_' . $value . '.php',
            ];

            if($this->createMigration($migration) === false)
            {
                $this->output(self::$CONSOLE_ERROR, 'Could not create migration. (' . $migration['file'] . ')');
            }
        }

        // To do, roll back migrations if any failed..
    }

    public function createMigration($migration)
    {
        array_push($this->migrationsOutput, $migration['file']);

        if(file_exists($migration['file']))
        {
            return false;
        }

        $fh = fopen($migration['file'], 'x');

        if($fh === false)
        {
            return false;
        }

        if(fwrite($fh, view()->make($migration['view'])->render()) === false)
        {
            return false;
        }

        fclose($fh);

        $this->output(self::$CONSOLE_INFO, 'Created migration. (' . $migration['file'] . ')');
        
        array_pop($this->migrationsOutput);

        return true;
    }
}
