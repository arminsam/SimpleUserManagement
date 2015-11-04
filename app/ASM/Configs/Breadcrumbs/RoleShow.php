<?php namespace ASM\Configs\Breadcrumbs;

use ASM\Foundation\BreadcrumbManager\BreadcrumbConfigInterface;

class RoleShow extends RoleIndex implements BreadcrumbConfigInterface {

    /**
     * Get the configuration data for displaying breadcrumb. The result
     * is an array of all the parts in the breadcrumb, including links and
     * their parameters.
     *
     * @param array $params
     *
     * @return array
     */
    public function getParts($params = [])
    {
        $config = $this->getBasicConfig($params);

        return $this->decorate($config);
    }

    /**
     * Get the initial config data before applying any decorators.
     *
     * @param array $params
     *
     * @return mixed
     */
    public function getBasicConfig($params = [])
    {
        return parent::getBasicConfig($params) + [
            'role' => [
                'text' => str_limit($params['role_name'], 15),
                'route' => 'role.show',
                'params' => [$params['role_id']]
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

}