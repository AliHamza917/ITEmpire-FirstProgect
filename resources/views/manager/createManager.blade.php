@extends('layouts.default')
@section('container')


    <div class="container">

        <form class="form-signin" id="manager-form" enctype="multipart/form-data">
{{--        <form class="form-signin" method="post" action="{{ route('createNewManager') }}" enctype="multipart/form-data">--}}
            @csrf
            <h2 class="form-signin-heading">Registration New Manager</h2>
            <div class="login-wrap">
                <p>Enter personal details below</p>
                <input type="text" name="fullname" id="fullname"  class="form-control" placeholder="Full Name" autofocus>
                <span id="fullname-error">
                @error('fullname')
                    {{$message}}
                    @enderror
            </span>

                <p> Enter your account details below</p>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" autofocus><br>
                <span id="email-error">
                @error('email')
                    {{$message}}
                    @enderror
            </span>
                <input type="password" name="pswd" id="pswd" class="form-control" placeholder="Password">
                <span id="pswd-error">
                @error('pswd')
                    {{$message}}
                    @enderror
            </span>

                <div class="fileupload">

                    <input class="form-control fileinput-button" type="file" name="profile-img" id="profile-img" class="form-control" required/>

                </div>
                <span id="profile-img-error">
                    @error('profile-img')
                    {{ $message }}
                    @enderror
                </span>
                <br>


                <button class="btn btn-md btn-login btn-block" type="submit">Create New User</button>



            </div>

        </form>

    </div>

@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#manager-form').on('submit', function(e) {
                e.preventDefault(); // Prevent normal form submission

                var formData = new FormData(this); // Gather all form data, including files

                $.ajax({
                    url: "{{ route('createNewManager') }}", // The route for the controller action
                    method: 'POST',
                    data: formData,
                    processData: false,  // Don't let jQuery process the form data
                    contentType: false,  // Don't set content-type (for file uploads)
                    success: function(response) {
                        if(response.success) {
                            alert('Manager created successfully');
                            window.location.href = "{{ route('UserTable') }}"; // Redirect after success
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // Laravel validation error status
                            const errors = xhr.responseJSON.errors;

                            $('#fullname-error').text(errors.fullname ? errors.fullname[0] : '');
                            $('#email-error').text(errors.email ? errors.email[0] : '');
                            $('#pswd-error').text(errors.pswd ? errors.pswd[0] : '');
                            $('#profile-img-error').text(errors['product-img'] ? errors['profile-img'][0] : '');
                        } else {
                            alert("Unexpected error: " + xhr.responseText);
                            console.error("Full error details:", xhr);
                        }
                    }
                    // error: function(xhr) {
                    //     // Handle validation errors
                    //     $('#fullname-error').text(xhr.responseJSON.errors.fullname ? xhr.responseJSON.errors.fullname[0] : '');
                    //     $('#email-error').text(xhr.responseJSON.errors.email ? xhr.responseJSON.errors.email[0] : '');
                    //     $('#pswd-error').text(xhr.responseJSON.errors.pswd ? xhr.responseJSON.errors.pswd[0] : '');
                    //     $('#profile-img-error').text(xhr.responseJSON.errors['profile-img'] ? xhr.responseJSON.errors['profile-img'][0] : '');
                    // }
                });
            });
        });
    </script>
@endsection
