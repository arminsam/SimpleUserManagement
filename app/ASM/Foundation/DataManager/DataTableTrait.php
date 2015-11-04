<?php namespace ASM\Foundation\DataManager;

use Illuminate\Http\Request;

trait DataTableTrait {

    protected $tableName;

    protected $limit;

    protected $sort;

    protected $sortDirection;

    protected $search;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->tableName = $this->model->getTable();
        $this->limit = $request->has('limit') ? (int) $request->get('limit') : 10;
        $this->sort = $request->has('sort') ? $request->get('sort') : $this->tableName . '.id';
        $this->sortDirection = $request->has('order') ? $request->get('order') : 'DESC';
        $this->search = $request->has('search') ? $request->get('search') : [];

        $this->fixColumnNames();
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function listData($query)
    {
        foreach ($this->search as $column => $search)
        {
            $query = $query->{'of' . ucfirst(camel_case(str_replace('.', '_', $column)))}($search);
        }

        return $query
            ->orderBy($this->sort, $this->sortDirection)
            ->select($this->tableName . '.*')
            ->paginate($this->limit);
    }

    /**
     * make sure columns have proper table alias before their name
     */
    private function fixColumnNames()
    {
        $this->sort = $this->fixTableAlias($this->sort);

        foreach ($this->search as $column => $search)
        {
            unset($this->search[$column]);
            $columnName = $this->fixTableAlias($column);
            $this->search[$columnName] = $search;
        }
    }

    /**
     * @param $name
     *
     * @return mixed|string
     */
    private function fixTableAlias($name)
    {
        $columnNamePieces = explode('.', $name);
        $tableAlias = implode('_', array_slice($columnNamePieces, 0, -1));
        $columnName = array_pop($columnNamePieces);

        return empty($tableAlias) ? $columnName : $tableAlias . '.' . $columnName;
    }

}
