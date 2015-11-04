<?php

if ( ! function_exists('active_menu'))
{
    /**
     * Determine whether the given menu is active based on current route name.
     *
     * @param  string $menu
     * @return boolean
     */
    function active_menu($menu)
    {
        switch ($menu)
        {
            case 'users' : return (Route::is('user*') || Route::is('company.user*') || Route::is('role.user*')) && !Route::is('user.process.index');
            case 'roles' : return (Route::is('role*') || Route::is('company.role*')) && !Route::is('role.user*');
        }
    }
}

if ( ! function_exists('user_can'))
{
    /**
     * A wrapper around Auth::user()->can().
     *
     * @param  string $capability
     * @return boolean
     */
    function user_can($capability)
    {
        return Auth::check() ? Auth::user()->can($capability) : false;
    }
}

if ( ! function_exists('is_superadmin'))
{
    /**
     * Determine whether current user is superadmin
     *
     * @return bool
     */
    function is_superadmin()
    {
        return Auth::check() ? (Auth::user()->superadmin == 1) : false;
    }
}

if ( ! function_exists('get_initials'))
{
    /**
     * Get the initial letters of a name
     *
     * @param $name
     *
     * @return string
     */
    function get_initials($name)
    {
        $nameArray = explode(' ', $name);

        if (count($nameArray) == 1)
        {
            $initials = strtoupper(substr($name, 0, 1)) . strtolower(substr($name, 1, 1));
        }
        else
        {
            $initials = strtoupper(substr($nameArray[0], 0, 1) . substr($nameArray[1], 0, 1));
        }

        $bgColor = substr(dechex(crc32($initials)), 0, 6);

        return compact('initials', 'bgColor');
    }
}