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
    <link href="../../lib/animate/animate.min.css" rel="stylesheet" />
    <link href="../../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link
        href="../../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css"
        rel="stylesheet"
    />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="../../css/style.css" rel="stylesheet" />
    <style>
        .fixed-height-img {
            height: 200px; /* Set the desired height for all images */
        }
    </style>
</head>
<body>
    
    <div class="container-fluid position-relative p-0">
    
    <div class="container-xxl  py-5" style="margin-top: 60px;">
      <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
          <h6 class="section-title bg-white text-center text-primary px-3">
            Rooms
          </h6>
          <h1 class="mb-5">Explore Our Rooms</h1>
        </div>
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
            
        <div class="row g-4">
            @foreach($rooms as $room)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="room-item shadow rounded overflow-hidden">
                    <div class="position-relative">
                        <img class="img-fluid rounded" src="{{ asset($room->Photo) }}" alt="House Photo" style="width: 100%;">
                    </div>
                    <div class="p-4 mt-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="mb-0">largeur: {{ $room->largeur }}  ,  Longueur: {{ $room->Longueur }}</h5>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="mb-0">Price: {{ $room->price }} dh</h5>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            @if($room->status === 'available')
                            <h5 class="mb-0 text-success">Status: {{ $room->status }}</h5>
                            @else
                            <h5 class="mb-0 text-danger">Status: {{ $room->status }}</h5>
                            @endif
                        </div>
                        <div class="d-flex justify-content-between">
                            @if(Auth::check() && Auth::user()->usertype === 'student')
                                @if($room->status === 'available')
                                    <form action="{{ route('reserve.room', ['roomId' => $room->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary rounded py-2 px-4 ml-2">Book Now</button>
                                    </form>
                                @else
                                    <button class="btn btn-sm btn-secondary rounded py-2 px-4 ml-2" disabled>Room Not Available</button>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>            
            @endforeach
        </div>
   
    </div> 
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
        <i class="bi bi-arrow-up"></i>
    </a> 
</div>
</body>
</html>


  