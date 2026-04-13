<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::updateOrCreate(
            ['email' => 'informaciones.ite@gmail.com'],
            [
                'name' => 'David',
                'password' => bcrypt('emanuel1326*')
            ]
        );

        User::updateOrCreate(
            ['email' => 'eduardcp20@gmail.com'],
            [
                'name' => 'Edward Carrillo Portillo',
                'password' => bcrypt('11387469')
            ]
        );

        //User::factory(99)->create();
    }
}
