<?php namespace ASM\Foundation\DataManager;

use Illuminate\Pagination\Paginator;

class DataTable {

    /**
     * @var array
     */
    public $columns;

    /**
     * @var array
     */
    public $actions;

    /**
     * @var array
     */
    public $data;

    /**
     * @param DataTableConfigInterface $config
     * @param Paginator $data
     */
    public function __construct(DataTableConfigInterface $config, Paginator $data)
    {
        $this->columns = $config->getColumns();
        $this->actions = $config->getActions();
        $this->data = $data;
    }

}