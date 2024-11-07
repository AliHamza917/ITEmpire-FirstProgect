@extends('layouts.default')
@section('container')
    <section>
        <div class="container">

            <form class="form-signin" id="addCategoryForm">
{{--            <form class="form-signin" method="post" action="{{ route('create-category') }}">--}}
                @csrf
                <h2 class="form-signin-heading">Add New Category</h2>
                <div class="login-wrap">
                    <input name="p_category" id="p_category" type="text" class="form-control" placeholder="Category Name">
                    <span>
                @error('p_category')
                        {{$message}}
                        @enderror
            </span>
                    <br>

                    <button class="btn btn-md btn-login btn-block" type="submit">Create Category</button>



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
            $('#addCategoryForm').on('submit', function(e) {
                e.preventDefault(); // Prevent normal form submission

                var formData = new FormData(this); // Gather all form data, including files

                $.ajax({
                    url: "{{ route('create-category')  }}", // The route for the controller action
                    method: 'POST',
                    data: formData,
                    processData: false,  // Don't let jQuery process the form data
                    contentType: false,  // Don't set content-type (for file uploads)
                    success: function(response) {
                        if(response.success) {
                            alert('New Category Added successfully');
                            window.location.href = "{{ route('CategoryTable') }}"; // Redirect after success
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                    },
                    error: function(xhr) {
                        // Handle validation errors
                        $('#p_category-error').text(xhr.responseJSON.errors['profile-img'] ? xhr.responseJSON.errors['Product Category-error'][0] : '');
                    }
                });
            });
        });
    </script>
@endsection

