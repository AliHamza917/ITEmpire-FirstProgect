<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="http://thevectorlab.net/flatlab/img/favicon.png">

    <title>FlatLab - Flat & Responsive Bootstrap Admin Template</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-reset.css')}}" rel="stylesheet">
    <!--external css-->
    <link href="{{asset('assets/font-awesome/css/font-awesome.css" rel="stylesheet')}}" />
    <!-- Custom styles for this template -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/style-responsive.css" rel="stylesheet')}}" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="{{asset('js/html5shiv.js')}}"></script>
    <script src="{{asset('js/respond.min.js')}}"></script>
    <![endif]-->
</head>

<body class="login-body">

<div class="container">

    <form class="form-signin" method="post" action="{{ route('signup') }}" enctype="multipart/form-data">
        @csrf
        <h2 class="form-signin-heading">registration now</h2>
        <div class="login-wrap">
            <p>Enter your personal details below</p>
            <input type="text" name="fullname"  class="form-control" placeholder="Full Name" autofocus>
            <span>
                @error('fullname')
                {{$message}}
                @enderror
            </span>

            <p> Enter your account details below</p>
            <input type="email" name="email" class="form-control" placeholder="Email" autofocus><br>
            <span>
                @error('email')
                {{$message}}
                @enderror
            </span>
            <input type="password" name="pswd" class="form-control" placeholder="Password">
            <span>
                @error('pswd')
                {{$message}}
                @enderror
            </span>

            <div class="fileupload">

                <input class="form-control fileinput-button" type="file" name="profile-img" class="form-control" required/>

            </div>
            @error('profile-img')
                 {{ $message }}
            @enderror
            <br>


            <button class="btn btn-md btn-login btn-block" type="submit">Submit</button>

            <div class="registration">
                Already Registered.
                <a class="" href="/">
                    Login
                </a>
            </div>

        </div>

    </form>

</div>


</body>
</html>
