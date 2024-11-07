@php $index= 1; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="http://thevectorlab.net/flatlab/img/favicon.png"/>

    <title>FlatLab - Flat & Responsive Bootstrap Admin Template</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/bootstrap-reset.css')}}" rel="stylesheet"/>
    <!--external css-->
    <link href="{{asset('assets/font-awesome/css/font-awesome.css" rel="stylesheet')}}" />
    <!-- Custom styles for this template -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('css/style-responsive.css" rel="stylesheet')}}" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="{{asset('js/html5shiv.js')}}"></script>
    <script src="{{asset('js/respond.min.js')}}"></script>
    <![endif]-->
</head>
<body>

<section id="container" >
    <!--header start-->
    <header class="header white-bg navbar-fixed-top">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <!--logo start-->
        <a href="index.html" class="logo">Flat<span>lab</span></a>
        <!--logo end-->

        <div class="top-nav ">
            <!--search & user info start-->
            <ul class="nav pull-right top-menu">
                <li>
                    <input type="text" class="form-control search" placeholder="Search">
                </li>
                <!-- user login dropdown start-->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="">
                        <img alt="" src="{{ asset('storage/profile-image/'.Auth::user()->profile_img) }}" width="50">
                        <span class="username">{{Auth::user()->fullname}}</span>

                    </a>

                </li>
                <li class="sb-toggle-right">
                    <i class="fa  fa-align-right"></i>
                </li>
                <!-- user login dropdown end -->
            </ul>
            <!--search & user info end-->
        </div>
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        <div id="sidebar"  class="nav-collapse navbar-left">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{ route('homePage') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    @if(session('role') === 'admin'  || session('role') === 'M')
                        <a href="user-table">Users Table</a>
                    @endif
                </li>

                <li>
                    @if(session('role') === 'admin')
                        <a href="{{route('createNewManagerView')}}">Create New Manager</a>
                    @endif
                </li>

                <li>
                    @if(session('role') === 'admin')
                        <a href="create-new-user-by-admin">Create New User</a>
                    @else
                        <a href="create-new-user">Create New User</a>
                    @endif
                </li>


                <li>
                    <a href="category-table">Category Table</a>

                </li>

                <li>
                    @if(session('role') === 'admin' || session('role') === 'M')
                        <a href="create-category">Add New Category</a>
                    @endif


                </li>
                <li>

                    @if(session('role') === 'user')
                    <a href="create-product">Add New Product</a>
                    @elseif(session('role')=== 'admin')
                        <a href="{{route('createProductByAdminView')}}">Add New Product</a>
                    @else
                    <a href="create-product-by-manager">Add New Product</a>
                    @endif
                </li>
                <li>
                    <a href="update-profile">Update Profile</a>

                </li>
                <li>

                    <a href="logout">Logout</a>
                </li>




            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <div class="row">
                <div class="">
                    <!--user info table start-->
                    <section class="panel">
                        <div class="panel-body">
                            @yield('container')
                        </div>

                    </section>
                    <!--user info table end-->
                </div>

            </div>

        </section>
    </section>
    <!--main content end-->

    <!--footer start-->
    <footer class="site-footer " style="position: static">
        <div class="text-center">

            <a href="index.html#" class="go-top">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
    </footer>
    <!--footer end-->
</section>

</body>
</html>
