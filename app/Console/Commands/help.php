<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class help extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:help {Advice}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this is help command';

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
        $name = $this->ask('Whats Help Name?');
        if( $this->confirm('Are you ready to insert '.$this->name .'?') )
        {
            $this->info('Help Added Successfully');
        }
        else
        {
            $this->error('Operation Cancelled');
        }

    }
}
