<?php

use App\Intelligence;
use App\User;
use Illuminate\Database\Seeder;

class TutorialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::lists('id')->all();
        $intelligences = Intelligence::lists('id')->all();

        for ($i = 0; $i <= 200; $i++) {
            factory('App\Tutorial')
                ->create([
                    'user_id' => $users[array_rand($users)],
                    'intelligence_id' => $intelligences[array_rand($intelligences)],
                ]);
        }
    }
}
