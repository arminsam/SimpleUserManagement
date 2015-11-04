<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu list-unstyled" id="nav-accordion">

            <li>
                @if(user_can('list_users'))
                    <a class="{{ active_menu('users') ? 'active' : '' }}" href="{{ route('user.index', []) }}">
                        <i class="fa fa-fw fa-user"></i>
                        <span>Users</span>
                    </a>
                @endif
            </li>

            <li>
                @if (user_can('list_roles'))
                    <a class="{{ active_menu('roles') ? 'active' : '' }}" href="{{ route('role.index', []) }}">
                        <i class="fa fa-fw fa-book"></i>
                        <span>Roles</span>
                    </a>
                @endif
            </li>
        </ul>
    </div>
</aside>
