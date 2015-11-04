<?php namespace ASM\Configs\DataTables;

use Illuminate\Support\Facades\Auth;
use ASM\Foundation\DataManager\DataTableConfigInterface;

class RoleDataTable implements DataTableConfigInterface {

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
                'label' => 'Role',
                'type' => 'text',
                'link' => 'role_show_link'
            ],
            'users' => [
                'name' => 'users',
                'label' => 'Users',
                'type' => 'text',
                'sortable' => false,
                'filterable' => false
            ],
            'created_at' => [
                'name' => 'created_at',
                'label' => 'Created On',
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
        $createRoute = 'role.create';

        return [
            'global' => [
                'create' => [
                    'route' => route($createRoute, $currentRouteParams),
                    'capability' => 'create_new_role'
                ],
                'delete' => [
                    'route' => (route('role.destroy.multiple', [])),
                    'capability' => 'delete_role'
                ]
            ],
            'record' => ['edit', 'delete']
        ];
    }

}