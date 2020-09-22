<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class OrderCommand extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'order:create';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'order command for creating orders data';

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
    factory(\App\Models\Order::class, 100)->create();
  }
}
