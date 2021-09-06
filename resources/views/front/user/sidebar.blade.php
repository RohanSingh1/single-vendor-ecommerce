<div class="col-lg-3 col-md-4">
    <div class="left-side-tabs">
        <div class="dashboard-left-links">
            <a href="{{ route('front.dashboard') }}" class="user-item {{ url()->current() == route('front.dashboard') ? 'active' : '' }}">
            <i class="uil uil-apps"></i>Overview</a>
            <a href="{{ route('front.myorders') }}" class="user-item {{ url()->current() == route('front.myorders') ? 'active' : '' }}">
                <i class="uil uil-box"></i>My Orders</a>
            <a href="{{ route('front.wishlists') }}" class="user-item {{ url()->current() == route('front.wishlists') ? 'active' : '' }}">
                <i class="uil uil-heart"></i>Shopping Wishlist</a>
            <a href="dashboard_my_addresses.html" class="user-item"><i
                    class="uil uil-location-point"></i>My Address</a>
                    <a href="{{ route('logout') }}" class="user-item"><i class="uil uil-exit"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></i>Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
        </div>
    </div>
</div>
