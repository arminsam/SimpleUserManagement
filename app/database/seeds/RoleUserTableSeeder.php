<?php

use ASM\Contexts\Roles\Role;
use ASM\Contexts\Users\User;

class RoleUserTableSeeder extends Seeder {

    public function run()
    {
        $this->tableSeed();
    }

    private function tableSeed()
    {
        $allUsers = User::all();
        $adminUsers = User::where('username', 'LIKE', '%2%')->get();
        $staffUsers = User::where('username', 'NOT LIKE', '%2%')->get();

        foreach ($adminUsers as $user)
        {
            $user->roles()->sync([Role::whereName('admin')->first()->id]);
        }
        foreach ($staffUsers as $user)
        {
            $user->roles()->sync([Role::whereName('staff')->first()->id]);
        }

        foreach ($allUsers as $user)
        {
            $user->roles()->attach(Role::whereName('user')->first()->id);
        }
    }

}