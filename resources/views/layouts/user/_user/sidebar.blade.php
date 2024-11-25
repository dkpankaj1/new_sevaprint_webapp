<ul id="side-menu">

    <li class="menu-title">Menu</li>

    <li>
        <a href="{{ route('dashboard') }}">
            <i data-feather="home"></i>
            <span> {{ __('common.menu.dashboard') }} </span>
        </a>
    </li>

    <li class="menu-title">{{__('common.menu.account')}}</li>

    <li>
        <a href="#sidebarAuth" data-bs-toggle="collapse">
            <i data-feather="users"></i>
            <span> {{__('common.menu.account')}} </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarAuth">
            <ul class="nav-second-level">
                <li>
                    <a href="{{ route('account.profile.index') }}">{{__('common.menu.myAccount')}}</a>
                </li>
                <li>
                    <a href="{{ route('account.profile.edit') }}">{{__('common.menu.profile update')}}</a>
                </li>
                <li>
                    <a href="{{ route('account.password.change') }}">{{__('common.menu.change password')}}</a>
                </li>
            </ul>
        </div>
    </li>

</ul>
