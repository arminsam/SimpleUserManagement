<?php namespace ASM\Foundation\BreadcrumbManager;

interface BreadcrumbConfigInterface {

    /**
     * Get the configuration data for displaying breadcrumb. The result
     * is an array of all the parts in the breadcrumb, including links and
     * their parameters.
     *
     * @param array $params
     *
     * @return array
     */
    public function getParts($params = []);

    /**
     * Get the initial config data before applying any decorators.
     *
     * @param array $params
     *
     * @return mixed
     */
    public function getBasicConfig($params = []);

    /**
     * Add the extra logic needed to finalize the config array before using it.
     *
     * @param $config
     *
     * @return mixed
     */
    public function decorate($config);

}