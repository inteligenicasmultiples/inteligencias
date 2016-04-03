<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User')
            ->create([
                'name' => 'Luis Montoya',
                'email' => 'luismec90@gmail.com'
            ]);

        for ($i = 0; $i <= 100; $i++) {
            factory('App\User')
                ->create();
        }
    }
}
