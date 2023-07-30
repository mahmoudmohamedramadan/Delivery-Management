<?php

use Illuminate\Database\Seeder;

class DelegateSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    factory(\App\Models\Delegate::class, 20)->create();
  }
}
