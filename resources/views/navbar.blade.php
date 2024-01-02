<header>
    <!-- Header Start -->
    <div class="header-area">
        <div class="main-header header-sticky">
            <div class="container-fluid">
                <div class="menu-wrapper">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="/home"><img src="assets/img/logo/logo.png" alt="" height="30px"></a>
                    </div>
                    <!-- Main-menu -->
                    <div class="main-menu d-none d-lg-block">
                        <nav>                                                
                            <ul id="navigation">  
                                <li><a href="/home">Home</a></li>
                                <li><a href="/shop">shop</a></li>
                                <li><a href="/order-list">My Order</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- Header Right -->
                    <div class="header-right">
                        <ul>

                            @if (Auth::check())
                                <li><a href="/logout" data-toggle="tooltip" data-placement="bottom" title="Logout"><i class="fa-solid fa-right-from-bracket fa-flip-horizontal fa-lg mx-3" style="color: #000000;"></i></a></li>
                            @else
                                <li><a href="/login" data-toggle="tooltip" data-placement="bottom" title="Login"><i class="fa-solid fa-right-to-bracket fa-lg mx-3" style="color: #000000;"></i></a></li>
                            @endif

                            <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Account"><i class="fa-solid fa-user fa-lg mx-3" style="color: #000000;"></i></a></li>

                            @if (Auth::check())
                                <li><a href="/cart" data-toggle="tooltip" data-placement="bottom" title="Shopping Cart"><i class="fa-solid fa-cart-shopping fa-lg mx-3" style="color: #000000;"></i></a></li>
                            @else
                                <li><a href="/login" data-toggle="tooltip" data-placement="bottom" title="Shopping Cart"><i class="fa-solid fa-cart-shopping fa-lg mx-3" style="color: #000000;"></i></a></li>
                            @endif
                            
                        </ul>
                    </div>
                </div>
                <!-- Mobile Menu -->
                <div class="col-12">
                    <div class="mobile_menu d-block d-lg-none"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>