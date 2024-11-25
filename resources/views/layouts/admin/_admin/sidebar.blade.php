<ul id="side-menu">

    <li class="menu-title">Menu</li>

    <li>
        <a href="{{ route('admin.dashboard') }}">
            <i data-feather="home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="menu-title">Pages</li>

    <li>
        <a href="#sidebarAuth" data-bs-toggle="collapse">
            <i data-feather="users"></i>
            <span> Users </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarAuth">
            <ul class="nav-second-level">
                <li>
                    <a href="{{ route('admin.users.index') }}">List</a>
                </li>
                <li>
                    <a href="#!">Register</a>
                </li>

            </ul>
        </div>
    </li>

</ul>
