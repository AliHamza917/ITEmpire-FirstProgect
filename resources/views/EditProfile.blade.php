@extends('layouts.default')
@section('container')

    <section>
        <div class="container">

            <form class="form-signin" id="uploadProfileForm" enctype="multipart/form-data">
{{--            <form class="form-signin" method="post" action="{{route('UpdateProfile' , Auth::user()->id)}}" enctype="multipart/form-data">--}}

                @csrf
                <h2 class="form-signin-heading">Upload Profile Pic</h2>
                <div class="login-wrap">

                    <div class="fileupload">

                        <input class="form-control fileinput-button" type="file" name="profile-img" id="profile-img" class="form-control" />

                    </div>
                    @error('profile-img')
                    {{ $message }}
                    @enderror
                    <br>

                    <button class="btn btn-md btn-login btn-block" type="submit">Update Profile Pic</button>



                </div>

                <!-- Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">


                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                                <button class="btn btn-success" type="button">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->

            </form>

        </div>

    </section>

@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#uploadProfileForm').on('submit', function(e) {
                e.preventDefault(); // Prevent normal form submission

                var formData = new FormData(this); // Gather all form data, including files

                $.ajax({
                    url: "{{ route('UpdateProfile' , Auth::user()->id) }}", // The route for the controller action
                    method: 'POST',
                    data: formData,
                    processData: false,  // Don't let jQuery process the form data
                    contentType: false,  // Don't set content-type (for file uploads)
                    success: function(response) {
                        if(response.success) {
                            alert('Profile Update successfully');
                            window.location.href = "{{ route('homePage') }}"; // Redirect after success
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                    },
                    error: function(xhr) {
                        // Handle validation errors
                       $('#profile-img-error').text(xhr.responseJSON.errors['profile-img'] ? xhr.responseJSON.errors['profile-img'][0] : '');
                    }
                });
            });
        });
    </script>
@endsection

