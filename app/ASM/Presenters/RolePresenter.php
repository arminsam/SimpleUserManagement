<?php namespace ASM\Presenters;

use Laracasts\Presenter\Presenter;

class RolePresenter extends Presenter {

    /**
     * @var bool
     */
    private $defaultMessage = true;

    /**
     * @return string
     */
    public function roleShowLink()
    {
        return link_to_route('role.show', str_limit($this->entity->name, 25), [$this->entity->id]);
    }

    /**
     * @return string
     */
    public function users()
    {
        return '<a href="' . route('role.user.index', [$this->entity->id]) . '"><span class="label ' . ($this->entity->users->count() == 0 ? 'label-default' : 'label-info') . '">' . $this->entity->users->count() . '</span></a>';
    }

    /**
     * @return mixed
     */
    public function createdAt()
    {
        return $this->entity->created_at->format('Y/m/d');
    }

    /**
     * @return mixed
     */
    public function capabilities()
    {
        return $this->getCapabilitiesMarkup();
    }

    /**
     * @return string
     */
    public function editAction()
    {
        $button = '';

        if (!user_can('update_role')) return $button;

        $button = '<a class="btn btn-xs btn-link btn-edit-record" href="'.route('role.edit', [$this->entity->id]).'">';
        $button .= '<i class="fa fa-edit"></i>';
        $button .= '</a>';

        return $button;
    }

    /**
     * @return string
     */
    public function deleteAction()
    {
        $button = '';

        if (!user_can('delete_role')) return $button;

        $button = '<a class="btn btn-xs btn-link btn-delete-record" href="'.route('role.destroy', [$this->entity->id]).'">';
        $button .= '<i class="fa fa-trash"></i>';
        $button .= '</a>';

        return $button;
    }

    /**
     * @return string
     */
    public function editButton()
    {
        $button = '';

        if (user_can('update_role'))
        {
            $this->defaultMessage = false;
            $button = '<a class="btn btn-warning btn-block" href="'.route('role.edit', [$this->entity->id]).'"><i class="fa fa-fw fa-edit"></i> Edit Role</a>';
        }

        return $button;
    }

    /**
     * @return string
     */
    public function deleteButton()
    {
        $button = '';

        if (user_can('delete_role'))
        {
            $this->defaultMessage = false;
            $button = '<a class="btn btn-danger btn-block btn-delete-record" href="'.route('role.destroy', [$this->entity->id]).'"><i class="fa fa-fw fa-trash"></i> Delete Role</a>';
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
    private function getCapabilitiesMarkup()
    {
        $markup = '<ul class="list-unstyled">';

        foreach ($this->entity->capabilities as $capability)
        {
            $markup .= '<li><i class="fa fa-fw fa-check text-success"></i> '.ucwords(str_replace('_', ' ', $capability->name)).'</li>';
        }

        $markup .= '</ul>';

        return $markup;
    }

}