<?php namespace ASM\Configs\DataTables;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use ASM\Contexts\Roles\Role;
use ASM\Foundation\DataManager\DataTableConfigInterface;

class UserDataTable implements DataTableConfigInterface {

    protected $rolesList;

    public function __construct()
    {
        $this->listAllRoles();
    }

    /**
     * Get the configuration data for displaying data table
     *
     * @return array
     */
    public function getColumns()
    {
        $config = $this->getAllColumns();

        return $this->decorate($config);
    }

    /**
     * Get all columns data before filtering them through the decorate function
     *
     * @return array
     */
    public function getAllColumns()
    {
        return [
            'name' => [
                'name' => 'name',
                'label' => 'Name',
                'type' => 'text',
                'link' => 'user_profile_link'
            ],
            'username' => [
                'name' => 'username',
                'label' => 'Username',
                'type' => 'text'
            ],
            'email' => [
                'name' => 'email',
                'label' => 'Email',
                'type' => 'text'
            ],
            'user.roles' => [
                'name' => 'user.roles',
                'label' => 'Roles',
                'type' => 'dropdown',
                'options' => $this->rolesList,
                'sortable' => false
            ],
            'created_at' => [
                'name' => 'created_at',
                'label' => 'Registered On',
                'type' => 'date',
                'format' => 'Y/m/d'
            ]
        ];
    }

    /**
     * Add the extra logic needed to finalize the config array before using it.
     *
     * @param $config
     *
     * @return mixed
     */
    public function decorate($config)
    {
        if (Route::is('role.user.index'))
        {
            unset($config['user.roles']);
        }

        return array_values($config);
    }

    /**
     * Get the list of all actions available globally and for each record.
     * For record actions, view presenter is responsible for the look and
     * functionality of each action button.
     *
     * @return array
     */
    public function getActions()
    {
        $currentRouteParams = \Route::current()->parameters();
        $createRoute = 'user.create';

        return [
            'global' => [
                'create' => [
                    'route' => route($createRoute, $currentRouteParams),
                    'capability' => 'register_other_users'
                ],
                'delete' => [
                    'route' => route('user.destroy.multiple', []),
                    'capability' => 'delete_user'
                ]
            ],
            'record' => ['edit', 'delete', 'restore']
        ];
    }

    /**
     * Get the list of all roles available
     */
    private function listAllRoles()
    {
        $this->rolesList = Role::distinct()->get(['name'])->lists('name', 'name');
    }

}