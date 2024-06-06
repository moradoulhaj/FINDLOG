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

    <div class="container-fluid mt-5"> <!-- Use container-fluid for full-width container -->
        <div class="row justify-content-center"> <!-- Center the column -->
            <div class="col-md-6"> <!-- Adjust column width as needed -->
                <div class="card" style="width: 400px;"> <!-- Adjust card width as needed -->
                    <div class="card-header bg-primary text-white">
                        Landlord Information
                    </div>
    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Name:</strong> {{ $landlord->firstName }} {{ $landlord->lastName }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Email:</strong> {{ $landlord->email }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Phone:</strong> {{ $landlord->tel }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
</body>
</html>