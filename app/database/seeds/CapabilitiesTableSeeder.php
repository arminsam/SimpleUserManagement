<?php

use ASM\Contexts\Capabilities\Capability;

class CapabilitiesTableSeeder extends Seeder {

    public function run()
    {
        // users related capabilities
        Capability::create(['name' => 'list_users', 'category' => 'users']);
        Capability::create(['name' => 'register_other_users', 'category' => 'users']);
        Capability::create(['name' => 'login', 'category' => 'users']);
        Capability::create(['name' => 'logout', 'category' => 'users']);
        Capability::create(['name' => 'update_user_password', 'category' => 'users']);
        Capability::create(['name' => 'update_other_users_password', 'category' => 'users']);
        Capability::create(['name' => 'update_user_profile', 'category' => 'users']);
        Capability::create(['name' => 'update_other_users_profile', 'category' => 'users']);
        Capability::create(['name' => 'update_user_roles', 'category' => 'users']);
        Capability::create(['name' => 'delete_user', 'category' => 'users']);
        Capability::create(['name' => 'restore_user', 'category' => 'users']);

        // roles related capabilities
        Capability::create(['name' => 'list_roles', 'category' => 'roles']);
        Capability::create(['name' => 'create_new_role', 'category' => 'roles']);
        Capability::create(['name' => 'delete_role', 'category' => 'roles']);
        Capability::create(['name' => 'update_role', 'category' => 'roles']);
    }

}