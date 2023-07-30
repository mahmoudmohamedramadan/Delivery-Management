<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MechanicCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mechanic:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'mechanic command for creating mechanic data';

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
     * @return int
     */
    public function handle()
    {
        \App\Models\Mechanic::factory(100)->create();
    }
}
