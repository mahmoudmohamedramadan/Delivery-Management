<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    // use command: composer dump-autoload if appear ay error
     factory(\App\User::class, 3)->create();
  }
}
