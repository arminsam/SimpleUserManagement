<?php namespace ASM\Contexts\Roles;

use Illuminate\Database\Eloquent\Collection;
use Laracasts\Commander\Events\EventGenerator;
use Laracasts\Presenter\PresentableTrait;
use ASM\Contexts\Capabilities\Capability;
use ASM\Contexts\Roles\Events\NewRoleWasCreated;
use ASM\Contexts\Roles\Events\RoleWasDeleted;
use ASM\Contexts\Roles\Events\RoleWasUpdated;
use ASM\Presenters\RolePresenter;

class Role extends \Eloquent {

	use EventGenerator, PresentableTrait;

    /**
     * @var array
     */
    protected $presenter = RolePresenter::class;

	/**
	 * @var array
     */
	protected $fillable = ['name', 'public'];

	/**
	 * @return mixed
     */
	public function users()
	{
		return $this->belongsToMany('ASM\Contexts\Users\User')->withTrashed();
	}

	/**
	 * @return mixed
     */
	public function capabilities()
	{
		return $this->belongsToMany('ASM\Contexts\Capabilities\Capability');
	}

    /**
     * @param $query
     * @param $name
     *
     * @return mixed
     */
    public function scopeOfName($query, $name)
    {
        if (empty($name))
        {
            return $query;
        }

        return $query->where('roles.name', 'LIKE', '%' . $name . '%');
    }

    /**
     * @param $query
     * @param $date
     *
     * @return mixed
     */
    public function scopeOfCreatedAt($query, $date)
    {
        if (empty($date))
        {
            return $query;
        }

        $startDate = date('Y-m-d 00:00:00', strtotime($date));
        $endDate = date('Y-m-d 23:59:59', strtotime($date));

        return $query->where('roles.created_at', '>=', $startDate)->where('roles.created_at', '<=', $endDate);
    }

    /**
     * @param $name
     * @param $capabilities
     *
     * @return mixed
     */
    public static function createNewRole($name, $capabilities)
	{
		$role = self::create(compact('name'));
        $role->capabilities()->sync($capabilities);

		$role->raise(new NewRoleWasCreated($role));

		return $role;
	}

	/**
	 * @param $roleId
	 * @param $name
	 * @param $capabilities
	 *
	 * @return mixed
	 */
    public static function updateRights($roleId, $name, $capabilities)
	{
		$role = self::findOrFail($roleId);
		$capabilities = $capabilities ? Capability::find($capabilities) : new Collection();

		$role->capabilities()->sync($capabilities->lists('id'));
		$role->update(compact('name'));

		$role->raise(new RoleWasUpdated($role));

		return $role;
	}

	/**
	 * @param $roleId
	 *
	 * @return mixed
	 */
	public static function deleteRole($roleId)
	{
		$role = self::with(['users', 'capabilities'])->findOrFail($roleId);
		$role->capabilities()->detach($role->capabilities->lists('id'));
		$role->users()->detach($role->users->lists('id'));

		$role->delete();

		$role->raise(new RoleWasDeleted($role));

		return $role;
	}

}