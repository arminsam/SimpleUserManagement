<?php namespace ASM\Configs\DataTables;

use ASM\Foundation\DataManager\DataTableConfigInterface;

class CapabilityDataTable implements DataTableConfigInterface {

    /**
     * Get the configuration data for displaying data table
     *
     * @return array
     */
    public function getColumns()
    {
        // TODO: Implement getColumns() method.
    }

    /**
     * Get all columns data before filtering them through the decorate function
     *
     * @return array
     */
    public function getAllColumns()
    {
        // TODO: Implement getAllColumns() method.
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
        // TODO: Implement decorate() method.
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
        // TODO: Implement getActions() method.
    }
}