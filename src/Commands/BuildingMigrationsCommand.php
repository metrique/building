<?php

namespace Metrique\Building\Commands;

use Illuminate\Console\Command;

class BuildingMigrationsCommand extends Command
{

    const CONSOLE_INFO = 0;
    const CONSOLE_ERROR = 1;
    const CONSOLE_COMMENT = 2;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'metrique:building-migrations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create building migration files.';

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
        'create_content_index',
        'create_content_page',
        'create_content_item',
        'create_content_group',
        'create_content_building',
        'create_content_building_structure',
        'create_content_building_type',
        'fk_content_index',
        'fk_content_page',
        'fk_content_item',
        'fk_content_building_structure'
    ];

    /**
     * Track any migration files that are created.
     *
     * @var array
     */
    protected $migrationsOutput = [ ];

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
                'view' => 'building::migrations.' . $value,
                'file' => base_path($this->migrationPath) . '/' . date('Y_m_d_His') . '_' . $value . '.php',
            ];

            if($this->createMigration($migration) === false)
            {
                $this->output(self::CONSOLE_ERROR, 'Could not create migration. (' . $migration['file'] . ')');
            }
        }
    }

    public function createMigration($migration)
    {
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

        $this->output(self::CONSOLE_INFO, 'Created migration. (' . $migration['file'] . ')');
        
        return true;
    }

    /**
     * Outputs information to the console.
     * @param int $mode 
     * @param string $message 
     * @return void
     */
    private function output($mode, $message, $newline = false) {

        $newline = $newline ? PHP_EOL : '';

        switch ($mode) {
            case self::CONSOLE_COMMENT:
                $this->comment('[-msg-] ' . $message . $newline);
            break;

            case self::CONSOLE_ERROR:
                $this->error('[-err-] ' . $message . $newline);
            break;
            
            default:
                $this->info('[-nfo-] ' . $message . $newline);
            break;
        }
    }

    /**
     * Helper method to make new lines, and comments look pretty!
     * @return void
     */
    private function newline() {
        $this->info('');    
    }
}
