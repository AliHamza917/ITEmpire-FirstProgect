@extends('layouts.default')
@section('container')


    <div class="container">

        <form class="form-signin" method="post" action="{{ route('create-new-user') }}" enctype="multipart/form-data">
            @csrf
            <h2 class="form-signin-heading">Registration New User</h2>
            <div class="login-wrap">
                <p>Enter personal details below</p>
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


                <button class="btn btn-md btn-login btn-block" type="submit">Create New User</button>



            </div>

        </form>

    </div>



@endsection
