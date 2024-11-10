{{--@extends('layouts.default')--}}
{{--@section('container')--}}
@include('layouts.default');
{{--    <section class="panel">--}}
{{--        <h1>Users Table</h1>--}}
{{--        <div class="panel-body">--}}
{{--            <section id="unseen">--}}
{{--                <table class="table table-bordered table-striped table-condensed">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}

{{--                        <th>ID</th>--}}
{{--                        <th>Name</th>--}}
{{--                        <th>Email</th>--}}
{{--                        <th>Role</th>--}}
{{--                        <th>User Profile</th>--}}
{{--                        <th>Status</th>--}}
{{--                        <th>Action</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @foreach($user as $users)--}}
{{--                        --}}{{--        {{dd($users)}}--}}
{{--                        @if($users->user_role === 'admin')--}}

{{--                        @else--}}
{{--                            <tr class="gradeX">--}}
{{--                                <td>{{$index++}}</td>--}}
{{--                                <td>{{$users->fullname}}</td>--}}
{{--                                <td>{{$users->email}}</td>--}}
{{--                                <td>{{$users->user_role}}--}}

{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <img alt="NoImage" src="{{ asset('storage/profile-image/'.$users->profile_img) }}" width="50">--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    @if($users->user_role === 'admin')--}}
{{--                                        <h4>Admin</h4>--}}
{{--                                    @else--}}

{{--                                        @if($users->status === '0')--}}
{{--                                            Rejected--}}
{{--                                        @else--}}
{{--                                            Approved--}}
{{--                                        @endif--}}

{{--                                    @endif--}}

{{--                                </td>--}}


{{--                                <td>--}}


{{--                                    @if($users->status === '0')--}}
{{--                                        <a class="btn btn-success" href="{{('UpdateStatus')}}/{{$users->id}}">Approve</a>--}}
{{--                                    @else--}}
{{--                                        <a class="btn btn-danger" href="{{('UpdateStatus')}}/{{$users->id}}">Reject</a>--}}
{{--                                    @endif--}}

{{--                                </td>--}}

{{--                                --}}{{--                                Make Manager Or User--}}

{{--                                @if(session('role') === 'admin')--}}

{{--                                    <td>--}}

{{--                                        @if($users->user_role === 'M')--}}
{{--                                            <a class="btn btn-danger " href="{{('update-role')}}/{{$users->id}}">Make User</a>--}}
{{--                                        @else--}}
{{--                                            <a class="btn btn-success " href="{{('update-role')}}/{{$users->id}}">Make Manager</a>--}}
{{--                                        @endif--}}


{{--                                    </td>--}}
{{--                        @endif--}}


{{--                        @endif--}}

{{--                    @endforeach--}}

{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </section>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--@endsection--}}


{{--@php $index= 1; @endphp--}}
{{--    <!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <meta name="description" content="">--}}
{{--    <meta name="author" content="Mosaddek">--}}
{{--    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">--}}
{{--    <link rel="shortcut icon" href="http://thevectorlab.net/flatlab/img/favicon.png">--}}

{{--    <title>FlatLab - Flat & Responsive Bootstrap Admin Template</title>--}}

{{--    <!-- Bootstrap core CSS -->--}}
{{--    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">--}}
{{--    <link href="{{asset('css/bootstrap-reset.css')}}" rel="stylesheet">--}}
{{--    <!--external css-->--}}
{{--    <link href="{{asset('assets/font-awesome/css/font-awesome.css" rel="stylesheet')}}" />--}}
{{--    <!-- Custom styles for this template -->--}}
{{--    <link href="{{asset('css/style.css')}}" rel="stylesheet">--}}
{{--    <link href="{{asset('css/style-responsive.css" rel="stylesheet')}}" />--}}

{{--    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->--}}
{{--    <!--[if lt IE 9]>--}}
{{--    <script src="{{asset('js/html5shiv.js')}}"></script>--}}
{{--    <script src="{{asset('js/respond.min.js')}}"></script>--}}
{{--    <![endif]-->--}}
{{--</head>--}}
{{--<body>--}}

{{--<section id="container" >--}}
{{--    <!--header start-->--}}
{{--    <header class="header white-bg navbar-fixed-top">--}}
{{--        <div class="sidebar-toggle-box">--}}
{{--            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>--}}
{{--        </div>--}}
{{--        <!--logo start-->--}}
{{--        <a href="index.html" class="logo">Flat<span>lab</span></a>--}}
{{--        <!--logo end-->--}}

{{--        <div class="top-nav ">--}}
{{--            <!--search & user info start-->--}}
{{--            <ul class="nav pull-right top-menu">--}}
{{--                <li>--}}
{{--                    <input type="text" class="form-control search" placeholder="Search">--}}
{{--                </li>--}}
{{--                <!-- user login dropdown start-->--}}
{{--                <li class="dropdown">--}}
{{--                    <a data-toggle="dropdown" class="dropdown-toggle" href="">--}}
{{--                        <img alt="" src="img/avatar1_small.jpg">--}}
{{--                        <span class="username">{{Auth::user()->fullname}}</span>--}}

{{--                    </a>--}}

{{--                </li>--}}
{{--                <li class="sb-toggle-right">--}}
{{--                    <i class="fa  fa-align-right"></i>--}}
{{--                </li>--}}
{{--                <!-- user login dropdown end -->--}}
{{--            </ul>--}}
{{--            <!--search & user info end-->--}}
{{--        </div>--}}
{{--    </header>--}}
{{--    <!--header end-->--}}
{{--    <!--sidebar start-->--}}
{{--    <aside>--}}
{{--        <div id="sidebar"  class="nav-collapse navbar-left">--}}
{{--            <!-- sidebar menu start-->--}}
{{--            <ul class="sidebar-menu" id="nav-accordion">--}}
{{--                <li>--}}
{{--                    <a class="active" href="{{ route('homePage') }}">--}}
{{--                        <i class="fa fa-dashboard"></i>--}}
{{--                        <span>Dashboard</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    @if(session('role') === 'admin')--}}
{{--                        <a href="user-table">Users Table</a>--}}
{{--                    @endif--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="products-table">Products Table</a>--}}

{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="category-table">Category Table</a>--}}

{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="create-category">Add New Category</a>--}}

{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="create-product">Add New Product</a>--}}

{{--                </li>--}}
{{--                <li>--}}

{{--                    <a href="logout">Logout</a>--}}
{{--                </li>--}}




{{--            </ul>--}}
{{--            <!-- sidebar menu end-->--}}
{{--        </div>--}}
{{--    </aside>--}}
{{--    <!--sidebar end-->--}}

{{--    <!--footer start-->--}}
{{--    <footer class="site-footer " >--}}
{{--        <div class="text-center">--}}
{{--            2013 &copy; FlatLab by VectorLab.--}}
{{--            <a href="index.html#" class="go-top">--}}
{{--                <i class="fa fa-angle-up"></i>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </footer>--}}
{{--    <!--footer end-->--}}
{{--</section>--}}

{{--</body>--}}
{{--</html>--}}
