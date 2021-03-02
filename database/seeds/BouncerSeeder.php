<?php

use Illuminate\Database\Seeder;

class BouncerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Bouncer::allow('super-user')->everything();
        Bouncer::forbid('user')->everything();
    }
}
