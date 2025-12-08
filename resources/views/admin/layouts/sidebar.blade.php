<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown active">
                <a href="{{ route('admin.dashboard') }}" class="nav-link has-dropdown"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">UI Management</li>
            <li class="dropdown">

                <ul class="sidebar-menu">
                    <li class="dropdown {{ setActive(['admin.slider.*', 'admin.category']) }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th"></i>
                            <span>Website Managment</span></a>
                        <ul class="dropdown-menu">
                            <li class="{{ setActive(['admin.slider.*']) }}"><a class="nav-link"
                                    href="{{ route('admin.slider.index') }}">Main
                                    Page Sliders</a></li>
                            <li class="{{ setActive(['admin.category.*']) }}"><a class="nav-link"
                                    href="{{ route('admin.category.index') }}">Main
                                    Page Categorries</a></li>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="sidebar-menu">
            <li class="menu-header">Products</li>
            <li
                class="dropdown {{ setActive([
                    'admin.products.*',
                    // 'admin.products-image-gallery.*',
                    // 'admin.products-variant.*',
                    // 'admin.products-variant-item.*',
                    // 'admin.seller-products.*',
                    // 'admin.seller-pending-products.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th"></i>
                    <span>Product Managment</span></a>
                <ul class="dropdown-menu">
                    <li
                        class="{{ setActive([
                            'admin.products.*',
                            // 'admin.products-image-gallery.*',
                            // 'admin.products-variant.*',
                            // 'admin.products-variant-item.*',
                        ]) }}">
                        <a class="nav-link" href="{{ route('admin.products.index') }}">Products</a>
                    </li>
                    {{-- <li class="{{ setActive(['admin.seller-products.*']) }}"><a class="nav-link"
                            href="{{ route('admin.seller-products.index') }}">Seller Products</a></li>
                    <li class="{{ setActive(['admin.seller-pending-products.*']) }}"><a class="nav-link"
                            href="{{ route('admin.seller-pending-products.index') }}">Seller Pending Products</a></li>
                    <li class="{{ setActive(['admin.reviews.*']) }}"><a class="nav-link"
                            href="{{ route('admin.reviews.index') }}">Product Reviews</a></li> --}}
            </li>
            </li>
        </ul>
    </aside>
</div>
