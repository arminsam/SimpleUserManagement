<?php namespace ASM\Presenters;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter {

    /**
     * @var bool
     */
    private $defaultMessage = true;

    /**
     * @return string
     */
    public function userAvatar()
    {
        $defaultAvatar = get_initials($this->entity->name);

        return 'holder.js/32x32?text=' . $defaultAvatar['initials'];
    }

    /**
     * @return string
     */
    public function userProfileLink()
    {
        $avatarSrc = $this->userAvatar();
        $avatar = '<img class="img-circle space-right5 display-inline-block" style="max-width: 32px;" data-src="'. $avatarSrc .'">';
        $name = is_null($this->entity->deleted_at)
            ? link_to_route('user.show', str_limit($this->entity->name, 25), [$this->entity->id])
            : str_limit($this->entity->name, 25);
        return $avatar . '&nbsp' . $name;
    }

    /**
     * @return string
     */
    public function username()
    {
        return str_limit($this->entity->username, 25);
    }

    /**
     * @return string
     */
    public function email()
    {
        return str_limit($this->entity->email, 35);
    }

    /**
     * @return string
     */
    public function userRoles()
    {
        return $this->entity->roles->isEmpty()
            ? '-'
            : $this->getRolesListMarkup();
    }

    /**
     * @return mixed
     */
    public function createdAt()
    {
        return $this->entity->created_at->format('Y/m/d');
    }

    /**
     * @return string
     */
    public function editAction()
    {
        $button = '';

        if ($this->entity->id == \Auth::user()->id && !user_can('update_user_profile')) return $button;
        if ($this->entity->id != \Auth::user()->id && !user_can('update_other_users_profile')) return $button;

        if (is_null($this->entity->deleted_at))
        {
            $button = '<a class="btn btn-xs btn-link btn-edit-record" href="' . route('user.edit', [$this->entity->id]) . '">';
            $button .= '<i class="fa fa-edit"></i>';
            $button .= '</a>';
        }

        return $button;
    }

    /**
     * @return string
     */
    public function deleteAction()
    {
        $button = '';

        if (!user_can('delete_user')) return $button;

        if (is_null($this->entity->deleted_at))
        {
            $button = '<a class="btn btn-xs btn-link btn-delete-record" href="'.route('user.destroy', [$this->entity->id]).'">';
            $button .= '<i class="fa fa-trash"></i>';
            $button .= '</button>';
        }

        return $button;
    }

    /**
     * @return string
     */
    public function restoreAction()
    {
        $button = '';

        if (!user_can('restore_user')) return $button;

        if (!is_null($this->entity->deleted_at))
        {
            $button = '<a class="btn btn-xs btn-link btn-delete-record" href="'.route('user.restore', [$this->entity->id]).'">';
            $button .= '<i class="fa fa-rotate-left"></i>';
            $button .= '</button>';
        }

        return $button;
    }

    /**
     * @return string
     */
    public function editButton()
    {
        $button = '';

        if (($this->entity->id == \Auth::user()->id && user_can('update_user_profile'))
            || ($this->entity->id != \Auth::user()->id && user_can('update_other_users_profile')))
        {
            $this->defaultMessage = false;
            $button = '<a class="btn btn-warning btn-block" href="'.route('user.edit', [$this->entity->id]).'"><i class="fa fa-fw fa-edit"></i> Edit User</a>';
        }

        return $button;
    }

    /**
     * @return string
     */
    public function deleteButton()
    {
        $button = '';

        if (is_null($this->entity->deleted_at) && user_can('delete_user'))
        {
            $this->defaultMessage = false;
            $button = '<a class="btn btn-danger btn-block btn-delete-record" href="'.route('user.destroy', [$this->entity->id]).'"><i class="fa fa-fw fa-trash"></i> Delete User</a>';
        }

        return $button;
    }

    /**
     * @return string
     */
    public function restoreButton()
    {
        $button = '';

        if (!is_null($this->entity->deleted_at) && user_can('restore_user'))
        {
            $this->defaultMessage = false;
            $button = '<a class="btn btn-primary btn-block" href="'.route('user.restore', [$this->entity->id]).'"><i class="fa fa-fw fa-rotate-left"></i> Restore User</a>';
        }

        return $button;
    }

    /**
     * @return string
     */
    public function updatePasswordButton()
    {
        $button = '';

        if (is_null($this->entity->deleted_at) && user_can('update_other_users_password'))
        {
            $this->defaultMessage = false;
            $button = '<a class="btn btn-default btn-block" href="'.route('user.edit.password', [$this->entity->id]).'"><i class="fa fa-fw fa-asterisk"></i> Update Password</a>';
        }

        return $button;
    }

    /**
     * @return string
     */
    public function defaultMessage()
    {
        return $this->defaultMessage ? '<div class="text-muted">No action is available.</div>' : '';
    }

    /**
     * @return string
     */
    private function getRolesListMarkup()
    {
        $markup = '';

        foreach ($this->entity->roles as $role)
        {
            $markup .= '<a href="' . route('role.show', [$role->id]) . '">';
            $markup .= '<span class="label label-info">';
            $markup .= $role->name;
            $markup .= '</span>';
            $markup .= '</a>&nbsp';
        }

        return empty($markup) ? '-' : $markup;
    }

}