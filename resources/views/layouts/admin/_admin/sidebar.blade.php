<ul id="side-menu">

    <li class="menu-title">Menu</li>

    <li>
        <a href="{{ route('admin.dashboard') }}">
            <i data-feather="home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li>
        <a href="#sidebarBalanceTransaction" data-bs-toggle="collapse">
            <i data-feather="book"></i>
            <span> Balance Transfer </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarBalanceTransaction">
            <ul class="nav-second-level">
                <li>
                    <a href="{{ route('admin.balance-transfer.create') }}">New</a>
                </li>
                <li>
                    <a href="{{ route('admin.balance-transfer.index') }}">List</a>
                </li>

            </ul>
        </div>
    </li>

    <li class="menu-title">Services</li>

    <li>
        <a href="{{ route('admin.mobile-recharge.index') }}">
            <i data-feather="check-square"></i>
            <span>Mobile Recharge</span>
        </a>
    </li>

    <li class="menu-title">Users</li>

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
                    <a href="{{ route('admin.users.create') }}">Register</a>
                </li>
            </ul>
        </div>
    </li>

    <li>
        <a href="#sidebarTransaction" data-bs-toggle="collapse">
            <i data-feather="credit-card"></i>
            <span> Transaction </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarTransaction">
            <ul class="nav-second-level">
                <li>
                    <a href="{{ route('admin.transaction.index') }}">List</a>
                </li>

            </ul>
        </div>
    </li>

    <li>
        <a href="{{ route('admin.feature.index') }}">
            <i data-feather="grid"></i>
            <span>Feature</span>
        </a>
    </li>

    <li class="menu-title">Settings</li>

    <li>
        <a href="#settings" data-bs-toggle="collapse">
            <i data-feather="settings"></i>
            <span> Setting </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="settings">
            <ul class="nav-second-level">
                <li>
                    <a href="{{ route('admin.settings.index') }}">All Setting</a>
                </li>

                <li>
                    <a href="{{ route('admin.settings.general') }}">General Setting</a>
                </li>
                <li>
                    <a href="{{ route('admin.settings.brand') }}">Brand Setting</a>
                </li>
                <li>
                    <a href=" {{ route('admin.settings.payment-getaway') }}">Payment Getaway</a>
                </li>
                <li>
                    <a href="{{ route('admin.settings.email') }}">Email Configuration</a>
                </li>
            </ul>
        </div>
    </li>

    <li>
        <a href="#websiteSettings" data-bs-toggle="collapse">
            <i data-feather="settings"></i>
            <span> Website Setting </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="websiteSettings">
            <ul class="nav-second-level">
                <li>
                    <a href="{{ route('admin.website.index') }}">All</a>
                </li>
                <li>
                    <a href="{{ route('admin.website.text-slider.index') }}">Text Slider</a>
                </li>
                <li>
                    <a href="{{ route('admin.website.about-us.edit') }}">About Us</a>
                </li>
                <li>
                    <a href="{{ route('admin.website.our-services.index') }}">Our Services</a>
                </li>
                <li>
                    <a href="{{ route('admin.website.videos.index') }}">Videos Section</a>
                </li>
            </ul>
        </div>
    </li>

    <li class="menu-title">Other</li>

    <li>
        <a href="{{ route('admin.messages.index') }}">
            <i data-feather="mail"></i>
            <span>Messages</span>
        </a>
    </li>

    <li class="menu-title">Account</li>

    <li>
        <a href="#sidebarAccount" data-bs-toggle="collapse">
            <i data-feather="user"></i>
            <span> Account </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarAccount">
            <ul class="nav-second-level">
                <li>
                    <a href="{{ route('admin.account.profile.index') }}">My Account</a>
                </li>
                <li>
                    <a href="{{ route('admin.account.profile.edit') }}">Profile Update</a>
                </li>
                <li>
                    <a href="{{ route('admin.account.password.change') }}">ChangePassword</a>
                </li>
            </ul>
        </div>
    </li>

    <li>
        <a href="{{ route('admin.server.index') }}">
            <i data-feather="server"></i>
            <span>Server Manager</span>
        </a>
    </li>

</ul>
