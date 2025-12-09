<div class="dashboard_sidebar">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="{{ route('user.dashboard') }}" class="dash_logo"><img src="{{ asset(@$logoSetting?->logo) }}" alt="logo"
            class="img-fluid"></a>
    <ul class="dashboard_link">
        {{-- <li><a class="{{ setActive(['user.dashboard.*']) }}" href="{{ route('user.dashboard') }}"><i
                    class="fas fa-tachometer"></i>Dashboard</a></li>
        @if (auth()->user()->role === 'vendor')
            <li><a class="" href="{{ route('vendor.dashboard') }}"><i class="fas fa-tachometer"></i>
                    Vendor Dashboard</a>
            </li>
        @endif
        <li><a href="/"><i class="far fa-home"></i> Go To Home Page</a></li>
        <li><a class="{{ setActive(['user.orders.*']) }}" href="{{ route('user.orders.index') }}"><i
                    class="fas fa-list-ul"></i> Orders</a></li>
        <li><a class="{{ setActive(['user.reviews.*']) }}" href="{{ route('user.reviews.index') }}"><i
                    class="fas fa-star"></i>Reviews</a></li>
        <li><a class="{{ setActive(['user.profile.*']) }}" href="{{ route('user.profile') }}"><i
                    class="fas fa-user"></i>My Profile</a></li>
        <li><a class="{{ setActive(['user.address.*']) }}" href="{{ route('user.address.index') }}"><i
                    class="fas fa-map-marker-alt"></i>Address</a></li>
        @if (auth()->user()->role !== 'vendor')
            <li><a class="{{ setActive(['user.vendor-request.*']) }}"
                    href="{{ route('user.vendor-request.index') }}"><i class="far fa-user"></i> Request to be
                    vendor</a></li>
        @endif
        <li><a class="{{ setActive(['user.messages.*']) }}" href="{{ route('user.messages.index') }}"><i
                    class="fas fa-envelope"></i>Messages</a>
        </li> --}}
        <li><a class="{{ setActive(['user.profile.*']) }}" href="{{ route('user.profile') }}"><i
                    class="fas fa-user"></i>My Profile</a></li>
        <li><a class="{{ setActive(['user.address.*']) }}" href="{{ route('user.address.index') }}"><i
                    class="fas fa-map-marker-alt"></i>Address</a></li>
        <li>
            <form method="POST" action="{{ route('logout') }}" class="dropdown-item has-icon text-danger">
                @csrf
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="dropdown-item">
                    {{ __('Log Out') }}
                </a>


            </form>
        </li>
    </ul>
</div>
