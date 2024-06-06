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


    <!-- Customized Bootstrap Stylesheet -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="../../css/style.css" rel="stylesheet" />
  </head>

  <body>
    <!-- Spinner Start -->
    {{-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>  --}}
    <!-- Spinner End -->
    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
      <!-- Navbar Start -->
      <nav
        class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0"
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
                <a href="{{ route('home') }}" class="nav-item nav-link">Home</a>
                <a href="{{ route('home') }}" class="nav-item nav-link">About</a>
                <a href="{{ route('home') }}" class="nav-item nav-link">Services</a>
                <a href="{{ route('student.houses.index') }}" class="nav-item nav-link">Houses</a>
                <a href="{{ route('home') }}" class="nav-item nav-link">Process</a>
        
            @if (Route::has('login'))
            @auth
                <a href="{{ route('user.reservations') }}" class="nav-item nav-link ">Reservations</a>
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

      <!-- Hero Start -->
      <div id="home" class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
          <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
              <div class="container">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif                
                <h2 class="text-light">Reservations</h2>
                <div class="table-responsive bg-light">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Room's Hieght</th>
                                <th>Room's Width</th>
                                <th>Room's Price</th>
                                <th>Room's Picture</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->room->Longueur }}</td>
                                <td>{{ $reservation->room->largeur }}</td>
                                <td>{{ $reservation->room->price }}</td>
                                <td>
                                  <img src="{{ asset($reservation->room->Photo) }}" alt="Room Photo" width="100">

                                </td>

                                {{-- <td>{{ $reservation->status }}</td> --}}
                                <td>
                                  @if ($reservation->status === 'pending')
                                      <span class="badge bg-warning">pending</span>
                                  @elseif ($reservation->status === 'accepted')
                                      <span class="badge bg-success">Accepted</span>
                                  @elseif ($reservation->status === 'declined')
                                      <span class="badge bg-danger">Refused</span>
                                  @endif
                              </td>
                                <td>
                                    @if($reservation->status === 'pending')
                                        <form action="{{ route('cancelReservation', $reservation->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Annuler</button>
                                        </form>
                                    @else
                                        <button class="btn btn-secondary" disabled>Annuler</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Navbar & Hero End -->

    

    <!-- Footer Start // No touch -->
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"
        ><i class="bi bi-arrow-up"></i
    ></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/wow/wow.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>
</html>
