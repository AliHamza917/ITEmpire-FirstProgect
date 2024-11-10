@extends('layouts.default')
@section('container')


    <div class="container">

        <form class="form-signin" id="createUserForm" enctype="multipart/form-data">
{{--        <form class="form-signin" id="createUserForm" method="post" action="{{ route('create-new-user') }}" enctype="multipart/form-data">--}}
            @csrf
            <h2 class="form-signin-heading">Registration New User</h2>
            <div class="login-wrap">
                <p>Enter personal details below</p>
                <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Full Name" autofocus>
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

                    <input class="form-control fileinput-button" id="profile-img" type="file" name="profile-img" class="form-control" required/>

                </div>
                <span id="profile-img-error"></span>
                @error('profile-img')
                {{ $message }}
                @enderror
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
            $('#createUserForm').on('submit', function(e) {
                e.preventDefault(); // Prevent normal form submission

                var formData = new FormData(this); // Gather all form data, including files

                $.ajax({
                    url: "{{ route('create-new-user') }}", // The route for the controller action
                    method: 'POST',
                    data: formData,
                    processData: false,  // Don't let jQuery process the form data
                    contentType: false,  // Don't set content-type (for file uploads)
                    success: function(response) {
                        if(response.success) {
                            alert('New User created successfully');
                            window.location.href = "{{ route('UserTable') }}"; // Redirect after success
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                    },
                    error: function(xhr) {

                        if (xhr.status === 422) { // Laravel validation error status
                            const errors = xhr.responseJSON.errors;

                            $('#fullname-error').text(errors.p_price ? errors.fullname[0] : '');
                            $('#email-error').text(errors.category_id ? errors.email[0] : '');
                            $('#pswd-error').text(errors.user_id ? errors.pswd[0] : '');
                            $('#profile-img-error').text(errors['product-img'] ? errors['profile-img'][0] : '');
                        } else {
                            alert("Unexpected error: " + xhr.responseText);
                            console.error("Full error details:", xhr);
                        }

                        // // Handle validation errors
                        // $('#p_name-error').text(xhr.responseJSON.errors.p_name ? xhr.responseJSON.errors.p_name-error[0] : '');
                        // $('#p_price-error').text(xhr.responseJSON.errors.p_price ? xhr.responseJSON.errors.p_price[0] : '');
                        // $('#category_id-error').text(xhr.responseJSON.errors.category_id ? xhr.responseJSON.errors.category_id[0] : '');
                        // $('#user_id-error').text(xhr.responseJSON.errors.user_id ? xhr.responseJSON.errors.user_id[0] : '');
                    }
                });
            });
        });
    </script>
@endsection

