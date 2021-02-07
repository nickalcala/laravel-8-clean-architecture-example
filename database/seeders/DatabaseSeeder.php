<?php

namespace Database\Seeders;

use Domain\User\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->hasPosts(2)->create();
    }
}
