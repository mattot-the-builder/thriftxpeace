<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Thrift X Peace</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    
    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <script src="https://kit.fontawesome.com/8eb16046d5.js" crossorigin="anonymous"></script>
</head>

<body>
    <!--? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    @include('navbar')
    <main>
        <!-- Hero Area Start-->
        <div class="slider-area ">
            <div class="single-slider slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Cart List</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--================Cart Area =================-->
        <section class="cart_area section_padding pt-5">
            
            @if (session('message'))
            <div class="alert alert-success mb-5 mx-auto w-75" role="alert">
                Item removed from cart
            </div>
            @endif
            
            <div class="container">
                <div class="cart_inner">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" colspan="2">Product</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @php
                                $total_cart = 0.0;
                                @endphp
                                
                                @foreach ($cart_items as $cart_item)
                                @foreach ($items as $item)
                                @if ($cart_item['item_id'] == $item['item_id'])
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="{{ asset('/storage/img/items/'.$item['image'] ) }}" alt="" />
                                            </div>
                                            <div class="media-body">
                                                <p>{{ $item['name'] }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="{{ '/remove/'.$cart_item['cart_id'] }}" class="btn btn-danger py-3 px-4" onclick="return confirm('Confirm remove item?')">Remove</a></td>
                                    <td>{{ $item['size'] }}</td>
                                    @php
                                    $total_cart += $item['price'];
                                    @endphp
                                    <td>RM {{ $item['price'] }}</td>
                                </tr>
                                @endif
                                @endforeach
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <h5>Total</h5>
                                    </td>
                                    <td>
                                        @php $total_cart += 5; @endphp
                                        <h5>RM {{ $total_cart }} <sup class="text-muted">* including shipping RM5</sup></h5>
                                        
                                    </td>
                                    
                                </tr>
                                
                                <tr class="shipping_area">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <form action="{{ route('checkout') }}" method="POST">
                                            @csrf
                                            <div class="shipping_box">
                                                <input class="post_code" type="text" name="address" placeholder="Street" required/>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="checkout_btn_inner float-right">
                                
                                @foreach ($cart_items as $cart_item)
                                <input type="hidden" name="items[]" value="{{ $cart_item['item_id'] }}">
                                @endforeach
                                <input type="hidden" name="total_price" value="{{ $total_cart }}">
                                <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!--================End Cart Area =================-->
        </main>>
        <footer>
            <!-- Footer Start-->
            <div class="footer-area footer-padding">
                <div class="container">
                    <div class="row d-flex justify-content-between">
                        <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="single-footer-caption mb-30">
                                    <!-- logo -->
                                    <div class="footer-logo">
                                        <a href="/home"><img src="assets/img/logo/logo1.png" alt=""></a>
                                    </div>
                                    <div class="footer-tittle">
                                        <div class="footer-pera">
                                            <p>Asorem ipsum adipolor sdit amet, consectetur adipisicing elitcf sed do eiusmod tem.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-3 col-sm-5">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Quick Links</h4>
                                    <ul>
                                        <li><a href="#">About</a></li>
                                        <li><a href="#"> Offers & Discounts</a></li>
                                        <li><a href="#"> Get Coupon</a></li>
                                        <li><a href="#">  Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-7">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>New Products</h4>
                                    <ul>
                                        <li><a href="#">Woman Cloth</a></li>
                                        <li><a href="#">Fashion Accessories</a></li>
                                        <li><a href="#"> Man Accessories</a></li>
                                        <li><a href="#"> Rubber made Toys</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-5 col-sm-7">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Support</h4>
                                    <ul>
                                        <li><a href="#">Frequently Asked Questions</a></li>
                                        <li><a href="#">Terms & Conditions</a></li>
                                        <li><a href="#">Privacy Policy</a></li>
                                        <li><a href="#">Report a Payment Issue</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Footer bottom -->
                    <div class="row align-items-center">
                        <div class="col-xl-7 col-lg-8 col-md-7">
                            <div class="footer-copy-right">
                                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>                  
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-4 col-md-5">
                                <div class="footer-copy-right f-right">
                                    <!-- social -->
                                    <div class="footer-social">
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="https://www.facebook.com/sai4ull"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-behance"></i></a>
                                        <a href="#"><i class="fas fa-globe"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer End-->
            </footer>
            <!--? Search model Begin -->
            <div class="search-model-box">
                <div class="h-100 d-flex align-items-center justify-content-center">
                    <div class="search-close-btn">+</div>
                    <form class="search-model-form">
                        <input type="text" id="search-input" placeholder="Searching key.....">
                    </form>
                </div>
            </div>
            <!-- Search model end -->
            
            <!-- JS here -->
            
            <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
            <!-- Jquery, Popper, Bootstrap -->
            <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
            <script src="./assets/js/popper.min.js"></script>
            <script src="./assets/js/bootstrap.min.js"></script>
            <!-- Jquery Mobile Menu -->
            <script src="./assets/js/jquery.slicknav.min.js"></script>
            
            <!-- Jquery Slick , Owl-Carousel Plugins -->
            <script src="./assets/js/owl.carousel.min.js"></script>
            <script src="./assets/js/slick.min.js"></script>
            
            <!-- One Page, Animated-HeadLin -->
            <script src="./assets/js/wow.min.js"></script>
            <script src="./assets/js/animated.headline.js"></script>
            <script src="./assets/js/jquery.magnific-popup.js"></script>
            
            <!-- Scrollup, nice-select, sticky -->
            <script src="./assets/js/jquery.scrollUp.min.js"></script>
            <script src="./assets/js/jquery.nice-select.min.js"></script>
            <script src="./assets/js/jquery.sticky.js"></script>
            
            <!-- contact js -->
            <script src="./assets/js/contact.js"></script>
            <script src="./assets/js/jquery.form.js"></script>
            <script src="./assets/js/jquery.validate.min.js"></script>
            <script src="./assets/js/mail-script.js"></script>
            <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
            
            <!-- Jquery Plugins, main Jquery -->	
            <script src="./assets/js/plugins.js"></script>
            <script src="./assets/js/main.js"></script>
            
            <script>
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            </script>
            
        </body>
        </html>