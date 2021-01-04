<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Entities\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name'          => 'Giovani',
            'cpf'           => '12345678910',
            'phone'         => '99999999999',
            'birth'         => '1999-10-28',
            'email'         => 'giovaninunes99@gmail.com',
            'password'      => bcrypt('123456'),  
        ]);
    }
}
