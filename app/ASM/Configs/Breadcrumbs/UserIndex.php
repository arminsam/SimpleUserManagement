<?php namespace ASM\Configs\Breadcrumbs;

use ASM\Foundation\BreadcrumbManager\BreadcrumbConfigInterface;

class UserIndex extends DashboardIndex implements BreadcrumbConfigInterface {

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
            'users' => [
                'text' => 'Users',
                'route' => 'user.index',
                'params' => []
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