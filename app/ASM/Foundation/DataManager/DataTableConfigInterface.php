<?php namespace ASM\Foundation\DataManager;

interface DataTableConfigInterface {

    /**
     * Get the configuration data for displaying data table
     *
     * @return array
     */
    public function getColumns();

    /**
     * Get all columns data before filtering them through the decorate function
     *
     * @return array
     */
    public function getAllColumns();

    /**
     * Add the extra logic needed to finalize the config array before using it.
     *
     * @param $config
     *
     * @return mixed
     */
    public function decorate($config);

    /**
     * Get the list of all actions available globally and for each record.
     * For record actions, view presenter is responsible for the look and
     * functionality of each action button.
     *
     * @return array
     */
    public function getActions();

}