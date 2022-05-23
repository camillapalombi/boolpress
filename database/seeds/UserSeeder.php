<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        User::create([
            'name'      => 'asdf',
            'email'     => 'asdf@asdf.asdf',
            'password'  => Hash::make('asdfasdf')
        ]);

        User::create([
            'name'      => 'qwer',
            'email'     => 'qwer@qwer.qwer',
            'password'  => Hash::make('qwerqwer')
        ]);

        for ($i=0; $i < 10; $i++) {
            User::create([
                'name'      => $faker->name(),
                'email'     => $faker->email(),
                'password'  => Hash::make('asdfasdf')
            ]);
        }
    }
}
