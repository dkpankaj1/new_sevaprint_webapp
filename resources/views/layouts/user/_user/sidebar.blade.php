<ul id="side-menu">

    <li class="menu-title">Menu</li>

    <li>
        <a href="{{ route('dashboard') }}">
            <i data-feather="home"></i>
            <span> {{ __('common.menu.dashboard') }} </span>
        </a>
    </li>

    <li class="menu-title">Feature</li>

    @featureMobileRechargeEnabled
        <li>
            <a href="#sidebarService001" data-bs-toggle="collapse">
                <i data-feather="smartphone"></i>
                <span>Recharge</span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarService001">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{ route('mobile-recharge.create', ['type' => 'mobile']) }}">Mobile Recharge</a>
                    </li>
                    <li>
                        <a href="{{ route('mobile-recharge.create', ['type' => 'dth']) }}">DTH Recharge</a>
                    </li>
                    <li>
                        <a href="{{ route('mobile-recharge.index') }}">History</a>
                    </li>
                </ul>
            </div>
        </li>
    @endfeatureMobileRechargeEnabled

    @nsdlPanFeatureEnabled
        <li>
            <a href="#sidebarService002" data-bs-toggle="collapse">
                <i data-feather="sidebar"></i>
                <span>NSDL PanCard</span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarService002">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{ route('nsdl.pan-card.create') }}">Apply</a>
                    </li>
                    <li>
                        <a href="{{ route('nsdl.pan-card.index') }}">PAN Applications</a>
                    </li>
                    <li>
                        <a href="{{ route('nsdl.transaction-status') }}">Transaction Status</a>
                    </li>
                    <li>
                        <a href="{{ route('nsdl.pan-status') }}">PAN Status</a>
                    </li>
                    <li>
                        <a href="https://tin.tin.nsdl.com/pantan/StatusTrack.html" target="_blank">PAN Status (NSDL)</a>
                    </li>
                </ul>
            </div>
        </li>
    @endnsdlPanFeatureEnabled

    <li class="menu-title">{{ __('common.menu.account') }}</li>

    <li>
        <a href="{{ route('wallet.index') }}">
            <i data-feather="credit-card"></i>
            <span>Wallet</span>
        </a>
    </li>

    <li>
        <a href="#sidebarAuth" data-bs-toggle="collapse">
            <i data-feather="users"></i>
            <span> {{ __('common.menu.account') }} </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarAuth">
            <ul class="nav-second-level">
                <li>
                    <a href="{{ route('account.profile.index') }}">{{ __('common.menu.myAccount') }}</a>
                </li>
                <li>
                    <a href="{{ route('account.charges') }}">My Charges</a>
                </li>
                <li>
                    <a href="{{ route('account.profile.edit') }}">{{ __('common.menu.profile update') }}</a>
                </li>
                <li>
                    <a href="{{ route('account.password.change') }}">{{ __('common.menu.change password') }}</a>
                </li>

            </ul>
        </div>
    </li>

</ul>
