<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>PFE</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="keywords" />
  <meta content="" name="description" />

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon" />

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap"
    rel="stylesheet"
  />

  <!-- Icon Font Stylesheet -->
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
    rel="stylesheet"
  />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    rel="stylesheet"
  />

  <!-- Libraries Stylesheet -->
  <link href="lib/animate/animate.min.css" rel="stylesheet" />
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
  <link
    href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css"
    rel="stylesheet"
  />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/bootstrap.min.css" rel="stylesheet" />

  <!-- Template Stylesheet -->
  <link href="css/style.css" rel="stylesheet" />
  <style>
      .fixed-height-img {
          height: 200px; /* Set the desired height for all images */
      }
  </style>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> 
    <!-- Spinner End -->
    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative pt-4">
      <!-- Navbar Start -->
    <nav
        class="bg-dark-lg navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0"
      >
        <a href="" class="navbar-brand p-0">
          <h1 class="text-primary m-0">
            <i class="fa fa-map-marker-alt me-3"></i>FINDLOG
          </h1>
        </a>
        <!-- NAVBAR TOGGLER -->
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarCollapse"
        >
          <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{route('home')}}" class="nav-item nav-link">Home</a>
                <a href="{{route('home')}}" class="nav-item nav-link">About</a>
                <a href="{{route('home')}}" class="nav-item nav-link">Services</a>
                <a href="{{route('student.houses.index')}}" class="nav-item nav-link active">Houses</a>
                <a href="" class="nav-item nav-link">Process</a>
        
            @if (Route::has('login'))
            @auth
                <a href="" class="nav-item nav-link ">Reservations</a>
              </div>
                <x-app-layout>
                </x-app-layout> 
            @else
              </div>
                <a href="{{route('login')}}" class="btn btn-primary rounded-pill py-2 px-4 mx-1">Log In</a>
                <a href="{{route('register')}}" class="btn btn-primary rounded-pill py-2 px-4">Register</a>
            @endauth
            @endif
        </div>
      </nav>
      <!-- Navbar End --> 

    <!-- Accomodations Start -->
    <div class="container-xxl  py-5" style="margin-top: 60px;">
      <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
          @if (session()->has('success'))
        <div class="alert alert-success">
        {{ session()->get('success') }}
         </div>
         @endif

          <h6 class="section-title bg-white text-center text-primary px-3">
            Houses
          </h6>
          <h1 class="mb-5">Explore Our Houses</h1>
        </div>
        <div class="row g-4">
            @foreach($houses as $house)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="room-item shadow rounded overflow-hidden">
                    <div class="position-relative">
                        <img class="img-fluid fixed-height-img" src="{{ asset('houseimages/'.$house->photo) }}" alt="room Photo" style="width: 100%;" />
                    </div>
                    <div class="p-4 mt-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="mb-0">{{ $house->nameHouse }}</h5>
                            <div class="ps-2">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                        </div>
                        <p class="text-body mb-3">{{ $house->adresse }}</p>
                        <div class="d-flex justify-content-between">
                            {{-- <a class="btn btn-sm btn-primary rounded py-2 px-4 ml-2" href="{{ route('landlord.info', ['house' => $house->id]) }}">Landlord Info</a> --}}
                            <a class="btn btn-sm btn-primary rounded py-2 px-4" href="{{ route('house.rooms', ['house' => $house->id]) }}">View Rooms</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        
        
      </div>
    </div>
    <!-- Accomodations End -->


    <!-- Footer Start // No touch -->
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"
        ><i class="bi bi-arrow-up"></i
    ></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>
