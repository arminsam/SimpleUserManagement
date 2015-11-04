<?php namespace ASM\Contexts\Capabilities\Repository;

use Illuminate\Http\Request;
use ASM\Contexts\Capabilities\Capability;
use ASM\Foundation\DataManager\DataTableTrait;
use ASM\Foundation\Repository\BaseRepository;

class CapabilityRepository extends BaseRepository implements CapabilityRepositoryInterface {

    use DataTableTrait {
        DataTableTrait::__construct as private __dtConstruct;
    }

    protected $model;

    /**
     * @param Request $request
     * @param Capability $model
     */
    public function __construct(Request $request, Capability $model)
    {
        $this->model = $model;
        $this->__dtConstruct($request);
    }

}