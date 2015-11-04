<header class="header dark-gray-bg">
    <div class="sidebar-toggle-box">
        <div data-original-title="Toggle Navigation" data-placement="right" class="fa fa-bars tooltips"></div>
    </div>
    <a href="{{ route('dashboard.index') }}" class="logo" >
        <span>SUMM</span>
    </a>
    <div class="top-nav">
        <ul class="nav pull-right top-menu">
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <img class="img-circle space-right5 hidden-lg hidden-md hidden-sm" style="max-width: 32px;" data-src="{{ Auth::user()->present()->userAvatar }}">
                    <span class="username hidden-xs">{{ str_limit(Auth::user()->name, 15) }}</span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <li><a href="{{ route('user.edit', [Auth::user()->id]) }}"><i class="fa fa-briefcase"></i> Profile</a></li>
                    <li><a href="{{ route('user.edit.password', [Auth::user()->id]) }}"><i class="fa fa-asterisk"></i> Password</a></li>
                    <li><a href="{{ route('logout.index') }}"><i class="fa fa-key"></i> Log Out</a></li>
                </ul>
            </li>
        </ul>
    </div>
</header>