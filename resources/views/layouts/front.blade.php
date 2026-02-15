<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title')</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <link href="{{asset('front/img/diamond.png')}}" rel="icon">
  <link href="{{asset('front/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <link href="{{asset('front/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('front/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('front/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link href="{{asset('front/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('front/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('front/vendor/drift-zoom/drift-basic.css')}}" rel="stylesheet">

  <link href="{{asset('front/css/main.css')}}" rel="stylesheet">

</head>

<body class="index-page">

    @include('layouts.front.header')

  <main class="main">

    @yield('content')

  </main>

 <footer id="footer" class="footer">

    <div class="footer-main">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="footer-widget footer-about">
              <a href="{{ route('front.index') }}" class="logo">
                <span class="sitename">Toko Emas Gombong-Safary</span>
              </a>

              <div class="footer-contact mt-4">
                <div class="contact-item">
                  <i class="bi bi-geo-alt"></i>
                  <span>Cilacap</span>
                </div>
                <div class="contact-item">
                  <i class="bi bi-telephone"></i>
                  <span>+62 9891823</span>
                </div>
                <div class="contact-item">
                  <i class="bi bi-envelope"></i>
                  <span>hello@example.com</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 col-sm-6">
            <div class="footer-widget">
              <h4>Shop</h4>
              <ul class="footer-links">
                <li><a href="category.html">New Arrivals</a></li>
                <li><a href="category.html">Bestsellers</a></li>
                <li><a href="category.html">Kids</a></li>
                <li><a href="category.html">Sale</a></li>
              </ul>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 col-sm-6">
            <div class="footer-widget">
              <h4>Support</h4>
              <ul class="footer-links">
                <li><a href="support.html">Help Center</a></li>
                <li><a href="account.html">Order Status</a></li>
                <li><a href="shiping-info.html">Shipping Info</a></li>
                <li><a href="return-policy.html">Returns &amp; Exchanges</a></li>
                <li><a href="#">Size Guide</a></li>
                <li><a href="contact.html">Contact Us</a></li>
              </ul>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 col-sm-6">
            <div class="footer-widget">
              <h4>Company</h4>
              <ul class="footer-links">
                <li><a href="about.html">About Us</a></li>
                <li><a href="about.html">Affiliates</a></li>
                <li><a href="about.html">Investors</a></li>
              </ul>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="footer-widget">
              <h4>Download Our App</h4>
              <p>Shop on the go with our mobile app</p>
              <div class="app-buttons">
                <a href="#" class="app-btn">
                  <i class="bi bi-apple"></i>
                  <span>App Store</span>
                </a>
                <a href="#" class="app-btn">
                  <i class="bi bi-google-play"></i>
                  <span>Google Play</span>
                </a>
              </div>
              <div class="social-links mt-4">
                <h5>Follow Us</h5>
                <div class="social-icons">
                  <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                  <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                  <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                  <a href="#" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>
                  <a href="#" aria-label="Pinterest"><i class="bi bi-pinterest"></i></a>
                  <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">

        <div class="payment-methods d-flex align-items-center justify-content-center">
          <div class="payment-icons">
            <i class="bi bi-credit-card" aria-label="Credit Card"></i>
            <i class="bi bi-paypal" aria-label="PayPal"></i>
            <i class="bi bi-apple" aria-label="Apple Pay"></i>
            <i class="bi bi-google" aria-label="Google Pay"></i>
            <i class="bi bi-shop" aria-label="Shop Pay"></i>
            <i class="bi bi-cash" aria-label="Cash on Delivery"></i>
          </div>
        </div>

        <div class="copyright text-center">
          <p>© <span>Copyright</span> <strong class="sitename">eStore</strong>. All Rights Reserved.</p>
        </div>


      </div>

    </div>
  </footer>


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{asset('front/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('front/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('front/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('front/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('front/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
  <script src="{{asset('front/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('front/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('front/vendor/drift-zoom/Drift.min.js')}}"></script>
  <script src="{{asset('front/vendor/purecounter/purecounter_vanilla.js')}}"></script>

  <!-- Main JS File -->
  <script src="{{asset('front/js/main.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @yield('js')
</body>

</html>
