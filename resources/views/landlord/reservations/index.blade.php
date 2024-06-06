
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>FINDLOG | HOUSE</title>
    <meta
      content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"
      name="viewport"
    />
    <!-- Bootstrap 3.3.2 -->
    <link
      href="../admin/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <!-- FontAwesome 4.3.0 -->
    <link
      href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <!-- Ionicons 2.0.0 -->
    <link
      href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <!-- Theme style -->
    <link href="../admin/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link
      href="../admin/dist/css/skins/skin-green.min.css"
      rel="stylesheet"
      type="text/css"
    />

    <!-- bootstrap wysihtml5 - text editor -->
    <link
      href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"
      rel="stylesheet"
      type="text/css"
    />
  </head>
  <body class="skin-green">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo"><b>Welcome Lanlord</b></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a
            href="#"
            class="sidebar-toggle"
            data-toggle="offcanvas"
            role="button"
          >
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs">{{ $landlord->firstName }} {{ $landlord->lastName }}</span>
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left info">
              <p>{{ $landlord->firstName }} {{ $landlord->lastName }}</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="{{route('home')}}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
              <!-- <ul class="treeview-menu">
                <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
              </ul> -->
            </li>
            <li class="treeview">
              <a href="{{route('landlord.house.index')}}">
                <i class="fa fa-files-o"></i>
                <span>Houses</span>
              </a>
            </li>
            <li class="treeview">
              <a href="{{route('landlord.rooms.index')}}">
                <i class="fa fa-pie-chart"></i>
                <span>Rooms</span>
              </a>
            </li>
            <li class="active treeview">
              <a href="{{route('landlord.reservations.index')}}">
                <i class="fa fa-pie-chart"></i>
                <span>Reservations </span>
              </a>
            </li>
            <li class="header">LABELS</li>

            <li class="treeview">
              <a href="{{ route('profile.show') }}">
                <i class="fa fa-laptop"></i>
                <span>Profile</span>
              </a>
            </li>
            <li class="treeview">
              <form method="POST" action="{{ route('logout') }}" x-data class="logout-form">
                  @csrf
                  <button type="submit" class="nav-link text-white logout-button" @click.prevent="$root.submit();">
                      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-laptop"></i>
                      </div>
                      <span class="nav-link-text ms-1">Log out</span>
                  </button>
              </form>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="#"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Reservations</li>
          </ol>
        </section>
        <!-- button and table for houses -->
        <div>
          <!-- button -->
          <!-- table -->
          <div class="row mytabl">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">My Reservations</h3>
                  <div class="box-tools"></div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <div class="col-6">
                      @if (session('success'))
                          <div class="alert alert-success alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              {{ session('success') }}
                          </div>
                      @elseif(session('error'))
                          <div class="alert alert-danger alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              {{ session('error') }}
                          </div>
                      @endif
                    </div>
                    <tr>
                      <th>HOUSE NAME</th>
                      <th>ROOM ID</th>
                      <th>STUDENT NAME</th>
                      <th>STUDENT PHONE</th>
                      <th>STUDENT EMAIL</th>
                      <th>STATUS</th>
                      @foreach ($reservations as $reservation)
                      @if ($reservation->status === 'pending')

                      <th>ACTIONS</th>
                      @endif
                    </tr>
                    
                        <tr>
                            <td>
                                <h6 >{{ $reservation->room->house->nameHouse }}</h6>
                            </td>
                            <td>
                              <h6 >{{ $reservation->room_id }}</h6>
                          </td>
                            <td>
                                <h6 >{{ $reservation->user->firstName }} {{ $reservation->user->lastName }}</h6>
                            </td>
                            <td >
                                <h6>{{ $reservation->user->tel }}</h6>
                            </td>
                            <td >
                                <h6>{{ $reservation->user->email }}</h6>
                            </td>
                            <td>
                              @if ($reservation->status === 'pending')
                                  <span class="badge bg-yellow">pending</span>
                              @elseif ($reservation->status === 'accepted')
                                  <span class="badge bg-green">Accepted</span>
                              @elseif ($reservation->status === 'declined')
                                  <span class="badge bg-red">Refused</span>
                              @endif
                          </td>
                          @if ($reservation->status === 'pending')

                            <td>
                                <a href="{{ route('acceptReservation', $reservation->id) }}" class="btn btn-success">Accepter</a>
                                <a href="{{ route('declineReservation', $reservation->id) }}" class="btn btn-danger">Refuser</a>
                                {{-- <a href="{{ route('cancelReservation', $reservation->id) }}" class="btn btn-warning">Annuler</a> --}}
                            </td>
                            @endif


                            {{-- <td>
                                <img src="{{ asset('houseimages/'.$house->photo) }}" alt="" style="width: 70px; height: 70px">
                            </td>      --}}
                            <td>
                              {{-- <a href="{{ route('landlord.house.edit', $house->id) }}" class="btn btn-primary">Edit</a> --}}
                              {{-- <form action="{{ route('landlord.house.destroy', $house->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this house?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form> --}}
                          </td>                     
                        </tr>
                    @endforeach
                  </table>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
          </div>
        </div>
        <!-- end button and table for houses -->
        <!-- /.box -->
      </div>

      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <strong>Copyright &copy; 2024 <a href="">FINDLOG</a>.</strong>
        All rights reserved.
      </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="../admin/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <script
      src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js"
      type="text/javascript"
    ></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge("uibutton", $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../admin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- Sparkline -->
    <script
      src="../admin/plugins/sparkline/jquery.sparkline.min.js"
      type="text/javascript"
    ></script>
    <!-- jvectormap -->
    <script
      src="../admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"
      type="text/javascript"
    ></script>
    <script
      src="../admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"
      type="text/javascript"
    ></script>
    <!-- jQuery Knob Chart -->
    <script src="../admin/plugins/knob/jquery.knob.js" type="text/javascript"></script>

    <!-- Bootstrap WYSIHTML5 -->
    <script
      src="../admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"
      type="text/javascript"
    ></script>
    <!-- FastClick -->
    <script src="../admin/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../admin/dist/js/app.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../admin/dist/js/pages/dashboard.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="../admin/dist/js/demo.js" type="text/javascript"></script>
  </body>
</html>



