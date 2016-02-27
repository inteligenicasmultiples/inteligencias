<?php

use App\Intelligence;
use Illuminate\Database\Seeder;

class IntelligenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory('App\Intelligence')
            ->create(['name' => 'Emocional']);

        factory('App\Intelligence')
            ->create(['name' => 'Matematica']);

        factory('App\Intelligence')
            ->create(['name' => 'Linguistica']);

    }
}
