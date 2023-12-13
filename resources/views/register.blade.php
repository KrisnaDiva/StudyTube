<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Register</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="images/favicon.ico" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="css/responsive.css">
   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
        <!-- Sign in Start -->
        <section class="sign-in-page">
          <div id="container-inside">
              <div class="cube"></div>
              <div class="cube"></div>
              <div class="cube"></div>
              <div class="cube"></div>
              <div class="cube"></div>
          </div>
            <div class="container p-0">
                <div class="row no-gutters height-self-center justify-content-center">
                  <div class="col-sm-8 align-self-center bg-primary rounded">
                    <div class="row m-0">
                      <div class="col-md-8 bg-white sign-in-page-data">
                          <div class="sign-in-from">
                              <h1 class="mb-0 text-center">Register</h1>
                              
                              <form class="mt-4" action="{{ route('register.store') }}" method="post">
                                @csrf
                                  <div class="form-group">
                                      <label for="name">Your Full Name</label>
                                      <input type="text" class="form-control mb-0 @error('name') is-invalid @enderror" id="name" name="name" placeholder="Your Full Name">
                                      @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                  </div>
                                  
                                  <div class="form-group">
                                      <label for="email">Email address</label>
                                      <input type="email" class="form-control mb-0 @error('email') is-invalid @enderror" id="email" name="email"placeholder="Enter email">
                                      @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                  </div>
                                  <div class="form-group">
                                      <label for="password">Password</label>
                                      <input type="password" class="form-control mb-0 @error('password') is-invalid @enderror" id="password" name="password"placeholder="Password">
                                      @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                  </div>
                               
                                  <div class="sign-info text-center">
                                      <button type="submit" class="btn btn-primary d-block w-100 mb-2">Register</button>
                                      <span class="text-dark d-inline-block line-height-2">Already Have Account ? <a href="{{ route('login') }}">Log In</a></span>
                                  </div>
                              </form>
                          </div>
                      </div>
                   
                    </div>
                  </div>
                </div>
            </div>
        </section>
        <!-- Sign in END -->
       
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- Appear JavaScript -->
      <script src="js/jquery.appear.js"></script>
      <!-- Countdown JavaScript -->
      <script src="js/countdown.min.js"></script>
      <!-- Counterup JavaScript -->
      <script src="js/waypoints.min.js"></script>
      <script src="js/jquery.counterup.min.js"></script>
      <!-- Wow JavaScript -->
      <script src="js/wow.min.js"></script>
      <!-- lottie JavaScript -->
      <script src="js/lottie.js"></script>
      <!-- Apexcharts JavaScript -->
      <script src="js/apexcharts.js"></script>
      <!-- Slick JavaScript -->
      <script src="js/slick.min.js"></script>
      <!-- Select2 JavaScript -->
      <script src="js/select2.min.js"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="js/owl.carousel.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="js/smooth-scrollbar.js"></script>
      <!-- Style Customizer -->
      <script src="js/style-customizer.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="js/custom.js"></script>
   </body>
</html>