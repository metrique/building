<?php

namespace Metrique\Building\Commands;

use Illuminate\Console\Command;
use Metrique\Building\Traits\BuildingCommandOutputTrait;

class BuildingSeedsCommand extends Command
{
    use BuildingCommandOutputTrait;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'metrique:seed-building';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create metrique/building seed files.';

    /**
     * Path to database seeds in your laravel app.
     *
     * @var string
     */
    protected $seedsPath = 'database/seeds';

    /**
     * List of seeds to be processed in order.
     *
     * @var array
     */
    protected $seeds = [
        'BuildingBlockTypesSeeder'
    ];

    /**
     * Track any seed files that are created.
     *
     * @var array
     */
    protected $seedsOutput = [];

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
        foreach ($this->seeds as $key => $value) {
            $seed = [
                'view' => 'metrique-building::seeds.' . $value,
                'file' => base_path($this->seedsPath) . '/' . $value . '.php',
            ];

            if($this->createSeed($seed) === false)
            {
                $this->output(self::$CONSOLE_ERROR, 'Could not create migration. (' . $seed['file'] . ')');
            }
        }

        // To do, roll back seeds if any failed..
    }

    public function createSeed($seed)
    {
        array_push($this->seedsOutput, $seed['file']);

        if(file_exists($seed['file']))
        {
            if(!$this->confirm('File exists, do you wish to overwrite? [y|N]'))
            {
                return false;
            }

        }

        $fh = fopen($seed['file'], 'w+');

        if($fh === false)
        {
            return false;
        }

        if(fwrite($fh, view()->make($seed['view'])->render()) === false)
        {
            return false;
        }

        fclose($fh);

        $this->output(self::$CONSOLE_INFO, 'Created seed. (' . $seed['file'] . ')');
        
        array_pop($this->seedsOutput);

        return true;
    }
}
