<?php

use App\Tutorial;
use App\User;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::lists('id')->all();
        $tutorials = Tutorial::lists('id')->all();

        for ($i = 0; $i <= 10000; $i++) {
            factory('App\Comment')
                ->create([
                    'user_id' => $users[array_rand($users)],
                    'tutorial_id' => $tutorials[array_rand($tutorials)],
                ]);
        }
    }
}
