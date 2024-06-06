<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>FINDLOG | Edit Room</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
    <!-- Bootstrap 3.3.2 -->
    <link href="../../../admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../../../admin/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link href="../../../admin/dist/css/skins/skin-green.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="skin-green">
    <div class="wrapper">
        <header class="main-header">
            <a href="index2.html" class="logo"><b>Welcome Landlord</b></a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="hidden-xs">{{$firstName}} {{$lastName}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left info">
                        <p>{{$firstName}} {{$lastName}}</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="treeview">
                        <a href="{{route('home')}}">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="{{route('landlord.house.index')}}">
                            <i class="fa fa-files-o"></i>
                            <span>Houses</span>
                        </a>
                    </li>
                    <li class="active treeview">
                        <a href="{{route('landlord.rooms.index')}}">
                            <i class="fa fa-th"></i> <span>Rooms</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="{{route('landlord.reservations.index')}}">
                            <i class="fa fa-pie-chart"></i>
                            <span>Reservations</span>
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
        </aside>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Edit Room</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-dashboard"></i> Home</a>
                    </li>
                    <li class="active">Edit Room</li>
                </ol>
            </section>
            <div class="box box-primary">
                <form action="{{ route('landlord.room.update', $room->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                      <div class="form-group">
                          <label for="Longueur">Room's Length</label>
                          <input type="number" name="Longueur" class="form-control" value="{{ old('Longueur', $room->Longueur) }}">
                          @error('Longueur')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                      <div class="form-group">
                          <label for="largeur">Room's Width</label>
                          <input type="number" name="largeur" class="form-control" value="{{ old('largeur', $room->largeur) }}">
                          @error('largeur')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                      <div class="form-group">
                          <label for="price">Price</label>
                          <input type="text" name="price" class="form-control" value="{{ old('price', $room->price) }}">
                          @error('price')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                      <div class="form-group">
                          <label for="status">Room Status</label>
                          <select name="status" class="form-control">
                              <option value="available" {{ old('status', $room->status) == 'available' ? 'selected' : '' }}>Available</option>
                              <option value="occupied" {{ old('status', $room->status) == 'occupied' ? 'selected' : '' }}>Occupied</option>
                          </select>
                          @error('status')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                      <div class="form-group">
                          <label for="id_house">House</label>
                          <select name="id_house" class="form-control">
                              @foreach($houses as $house)
                                  <option value="{{ $house->id }}" {{ old('id_house', $room->id_house) == $house->id ? 'selected' : '' }}>{{ $house->nameHouse }}</option>
                              @endforeach
                          </select>
                          @error('id_house')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Update Room</button>
                    </div>
                </form>
            </div>
        </div>
        <footer class="main-footer">
            <strong>Copyright &copy; 2024 <a href="">FINDLOG</a>.</strong>
            All rights reserved.
        </footer>
    </div>
</body>
</html>


