<?php

use Faker\Factory as Faker;
use ASM\Contexts\Roles\Role;

class RolesTableSeeder extends Seeder {

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
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'staff']);
        Role::create(['name' => 'user']);
    }

}