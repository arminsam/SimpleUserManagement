<?php

use Faker\Factory as Faker;
use ASM\Contexts\Users\User;

class UsersTableSeeder extends Seeder {

	public function run()
	{
        $faker = Faker::create();

        $this->seedTable($faker);
	}

    /**
     * @param $faker
     */
    private function seedTable($faker)
    {
        foreach(range(1, 25) as $index)
        {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'username' => $faker->word . $index,
                'password' => '123456'
            ]);
        }

        User::create([
            'name' => 'Site Admin',
            'email' => 'admin@site.com',
            'username' => 'superadmin',
            'password' => '123456',
            'superadmin' => 1
        ]);
    }

}