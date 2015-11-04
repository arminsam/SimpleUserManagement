<?php namespace ASM\Configs\Breadcrumbs;

use ASM\Foundation\BreadcrumbManager\BreadcrumbConfigInterface;

class UserCreate extends UserIndex implements BreadcrumbConfigInterface {

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
            'create' => [
                'text' => 'Create',
                'route' => '',
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