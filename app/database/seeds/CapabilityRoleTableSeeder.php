<?php

use ASM\Contexts\Roles\Role;
use ASM\Contexts\Capabilities\Capability;

class CapabilityRoleTableSeeder extends Seeder {

    public function run()
    {
        $this->tableSeed();
    }

    private function tableSeed()
    {
        $adminCapabilities = Capability::all();
        $userCapabilities = Capability::whereIn('name', ['login', 'logout',
            'access_admin_dashboard'])->get();
        $staffCapabilities = Capability::whereIn('name', ['login', 'logout',
            'access_admin_dashboard', 'update_user_profile', 'update_user_password'])->get();

        $admins = Role::whereName('admin')->get();
        $staff = Role::whereName('staff')->get();
        $users = Role::whereName('user')->get();

        foreach ($admins as $admin)
        {
            $admin->capabilities()->sync($adminCapabilities->lists('id'));
        }

        foreach ($staff as $staff)
        {
            $staff->capabilities()->sync($staffCapabilities->lists('id'));
        }

        foreach ($users as $user)
        {
            $user->capabilities()->sync($userCapabilities->lists('id'));
        }
    }

}