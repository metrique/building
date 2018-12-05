<?php

namespace Metrique\Building\Commands;

use Illuminate\Console\Command;
use Metrique\Building\Traits\BuildingCommandOutputTrait;
use Metrique\Building\Database\Seeds\ComponentTypeSeeder;

class BuildingSeedsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'metrique:building-seed';

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
    protected $seedsPath = 'seeds';

    /**
     * List of seeds to be processed in order.
     *
     * @var array
     */
    protected $seeds = [
        \Metrique\Building\Database\Seeds\ComponentTypeSeeder::class,
    ];

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
        $this->info('Starting laravel-building database seeding...');

        try {
            foreach ($this->seeds as $key => $value) {
                $seed = new $value();
                $seed->run();
                $this->info('Seeded: ' . $value);
            }
        } catch (Exception $e) {
            return $this->error('Seeding failed...');
        }

        $this->info('Seeding complete...');
    }
}
