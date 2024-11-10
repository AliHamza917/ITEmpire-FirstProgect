@extends('layouts.default')
@section('container')
    <div class="container">

        <form class="form-signin" id="createProductManagerForm" enctype="multipart/form-data">
{{--        <form class="form-signin" id="createProductManagerForm" method="post" action="{{ route('create-product-by-manager') }}" enctype="multipart/form-data">--}}
            @csrf
            <h2 class="form-signin-heading">Add A Product by Manager</h2>
            <div class="login-wrap">
                <input name="p_name" id="p_name" type="text" class="form-control" placeholder="Product Name">
                <span id="p_name-error" class="text-danger"></span> <!-- Add this line -->

                <br><input type="text" name="p_price" id="p_price" class="form-control" placeholder="Product Price">
                @error('p_price')
                {{$message}}
                @enderror

                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
                <span>
            @error('category_id')
                    {{ $message }}
                    @enderror
        </span><br>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="">Select User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                    @endforeach
                </select>
                <span>
            @error('user_id')
                    {{ $message }}
                    @enderror
        </span>
                <br>
                <div class="fileupload">

                    <input class="form-control fileinput-button" type="file" name="product-img" class="form-control" required/>

                </div>
                @error('product-img')
                {{ $message }}
                @enderror
                <br>

                <button class="btn btn-md btn-login btn-block" type="submit">Create Product</button>



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


@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#createProductManagerForm').on('submit', function(e) {
                e.preventDefault(); // Prevent normal form submission

                var formData = new FormData(this); // Gather all form data, including files

                $.ajax({
                    url: "{{ route('create-product-by-manager') }}", // The route for the controller action
                    method: 'POST',
                    data: formData,
                    processData: false,  // Don't let jQuery process the form data
                    contentType: false,  // Don't set content-type (for file uploads)
                    success: function(response) {
                        if(response.success) {
                            alert('Product created successfully');
                            window.location.href = "{{ route('ProductsTable') }}"; // Redirect after success
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                    },
                    error: function(xhr) {

                        if (xhr.status === 422) { // Laravel validation error status
                            const errors = xhr.responseJSON.errors;

                            $('#p_name-error').text(errors.p_name ? errors.p_name[0] : '');
                            $('#p_price-error').text(errors.p_price ? errors.p_price[0] : '');
                            $('#category_id-error').text(errors.category_id ? errors.category_id[0] : '');
                            $('#user_id-error').text(errors.user_id ? errors.user_id[0] : '');
                            $('#product-img-error').text(errors['product-img'] ? errors['product-img'][0] : '');
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
