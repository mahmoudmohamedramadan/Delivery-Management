<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class HelpCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:help {advice}';

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
        $name = $this->ask('What is help name?');

        if ($this->confirm('Are you ready to insert ' . $name . '?')) {
            $this->info('Help Added Successfully');
        } else {
            $this->error('Operation Cancelled');
        }
    }
}
