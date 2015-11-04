<?php namespace ASM\Contexts\Capabilities;

use Laracasts\Presenter\PresentableTrait;
use ASM\Presenters\CapabilityPresenter;

class Capability extends \Eloquent {

    use PresentableTrait;

    /**
     * @var array
     */
    protected $presenter = CapabilityPresenter::class;

	/**
	 * @var array
     */
	protected $fillable = [];

	/**
	 * @return mixed
     */
	public function roles ()
	{
		return $this->belongsToMany('ASM\Contexts\Roles\Role');
	}

}