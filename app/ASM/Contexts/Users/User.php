<?php namespace ASM\Contexts\Users;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laracasts\Commander\Events\EventGenerator;
use Laracasts\Presenter\PresentableTrait;
use ASM\Contexts\Roles\Role;
use ASM\Contexts\Users\Events\AnonymousUserHasRegistered;
use ASM\Contexts\Users\Events\UserWasDeleted;
use ASM\Contexts\Users\Events\UserWasRestored;
use ASM\Foundation\Exceptions\InvalidLoginCredentialsException;
use ASM\Contexts\Users\Events\UserHasLoggedIn;
use ASM\Contexts\Users\Events\UserHasLoggedOut;
use ASM\Contexts\Users\Events\UserHasRegistered;
use ASM\Contexts\Users\Events\UserPasswordWereUpdated;
use ASM\Contexts\Users\Events\UserProfileWasUpdated;
use ASM\Contexts\Users\Events\UserRolesWereUpdated;
use ASM\Presenters\UserPresenter;

class User extends \Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, EventGenerator, SoftDeletingTrait, PresentableTrait;

    /**
     * @var array
     */
    protected $presenter = UserPresenter::class;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * Set which attributes can be mass assigned
	 *
	 * @var array
     */
	protected $fillable = ['email', 'name', 'username', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token', 'superadmin'];

	/**
	 * @return mixed
     */
	public function roles()
	{
		return $this->belongsToMany('ASM\Contexts\Roles\Role');
	}

	/**
	 * Passwords need to be hashed before saving into database
	 *
	 * @param $password
	 */
	public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = Hash::make($password);
	}

	/**
	 * @param $userId
	 *
	 * @return Collection
     */
    public function capabilities($userId = null)
	{
		$userId = $userId ?: $this->id;

        if (\Cache::has('user_capabilities_'.$userId))
        {
            return $value = \Cache::get('user_capabilities_'.$userId);
        }

		$user = static::with(['roles', 'roles.capabilities'])->findOrFail($userId);
		$capabilities = new Collection();

		foreach($user->roles as $role)
		{
			$capabilities = $capabilities->merge($role->capabilities);
		}

        \Cache::forever('user_capabilities_'.$userId, $capabilities);

		return $capabilities;
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

        return $query->where('users.name', 'LIKE', '%' . $name . '%');
    }

    /**
     * @param $query
     * @param $username
     *
     * @return mixed
     */
    public function scopeOfUsername($query, $username)
    {
        if (empty($username))
        {
            return $query;
        }

        return $query->where('users.username', 'LIKE', '%' . $username . '%');
    }

    /**
     * @param $query
     * @param $email
     *
     * @return mixed
     */
    public function scopeOfEmail($query, $email)
    {
        if (empty($email))
        {
            return $query;
        }

        return $query->where('users.email', 'LIKE', '%' . $email . '%');
    }

    /**
     * @param $query
     * @param $role
     *
     * @return mixed
     */
    public function scopeOfUserRoles($query, $role)
    {
        if (empty($role))
        {
            return $query;
        }

        return $query->whereHas('roles', function($q) use ($role)
        {
            return $q->where('name', '=', $role);
        });
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

        return $query->where('users.created_at', '>=', $startDate)->where('users.created_at', '<=', $endDate);
    }

	/**
	 * @param $query
	 * @param array|string|int $roles
	 *
	 * @return mixed
     */
    public function scopeOfRoles($query, $roles)
	{
		return $query->whereHas('roles', function($q) use ($roles)
		{
            $q->where(function($q2) use ($roles)
            {
                if (is_array($roles))
                {
                    $q2->whereIn('roles.name', $roles)->orWhereIn('roles.id', $roles);
                }
                else
                {
                    $q2->where('roles.name', $roles)->orWhere('roles.id', $roles);
                }
            });
		});
	}

	/**
	 * @param string $capability
	 *
	 * @return bool
     */
    public function can($capability)
	{
		return $this->superadmin || in_array($capability, $this->capabilities()->lists('name'));
	}

    /**
     * Create a new user model based on the given email, username, password
     *
     * @param string $email
     * @param $name
     * @param string $username
     * @param string $password
     * @param $anonymousUser
     *
     * @return User
     */
    public static function register($email, $name, $username, $password, $anonymousUser)
	{
        $user = self::create(compact('email', 'name', 'username', 'password'));

        if ($anonymousUser)
        {
             $user->raise(new AnonymousUserHasRegistered($user, $password));
        }
        else
        {
		    $user->raise(new UserHasRegistered($user, $password));
        }

		return $user;
	}

    /**
     * @param $username
     * @param $password
     *
     * @return mixed $user
     * @throws InvalidLoginCredentialsException
     */
    public static function login($username, $password)
	{
		// Allow login via username or email
		$field = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

		if (Auth::attempt([$field => $username, 'password' => $password]))
		{
			$user = Auth::user();

			$user->raise(new UserHasLoggedIn($user));

			return $user;
		}

		throw new InvalidLoginCredentialsException('Invalid Login Credentials');
	}

	/**
	 * @return mixed
     */
	public static function logout()
	{
		$user = Auth::user();

		Auth::logout();

		$user->raise(new UserHasLoggedOut($user));

		return $user;
	}

    /**
     * @param $userId
     * @param $email
     * @param $username
     * @param $name
     *
     * @return mixed
     */
    public static function updateProfile($userId, $email, $username, $name)
	{
		$user = self::findOrFail($userId);

		$user->update(compact('email', 'username', 'name'));

		$user->raise(new UserProfileWasUpdated($user));

		return $user;
	}

    /**
     * @param $userId
     * @param $password
     *
     * @return mixed
     */
    public static function updatePassword($userId, $password)
	{
		$user = self::findOrFail($userId);

		$user->update(['password' => $password]);

		$user->raise(new UserPasswordWereUpdated($user));

		return $user;
	}

	/**
	 * @param $userId
	 * @param $roleIds
	 *
	 * @return mixed
     */
    public static function updateRoles($userId, $roleIds)
	{
		$user = self::findOrFail($userId);
        $defaultRoleId = [Role::whereName('user')->first()->id];

		$user->roles()->sync(array_merge($roleIds, $defaultRoleId));

		$user->raise(new UserRolesWereUpdated($user));

		return $user;
	}

	/**
	 * @param $userId
	 *
	 * @return mixed
	 */
	public static function deleteUser($userId)
	{
		$user = self::findOrFail($userId);

		$user->delete();

		$user->raise(new UserWasDeleted($user));

		return $user;
	}

    /**
     * @param $userId
     *
     * @return mixed
     */
    public static function restoreUser($userId)
    {
        $user = self::withTrashed()->findOrFail($userId);

        $user->restore();

        $user->raise(new UserWasRestored($user));

        return $user;
    }

}
