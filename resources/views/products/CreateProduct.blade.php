@extends('layouts.default')
@section('container')

    <div class="container">

        <form class="form-signin" id="createProductForm" enctype="multipart/form-data">
{{--        <form class="form-signin" id="createProductForm" method="post" action="{{ route('create-product') }}" enctype="multipart/form-data">--}}
            @csrf
            <h2 class="form-signin-heading">Add A Product</h2>
            <div class="login-wrap">
                <input name="p_name" id="p_name" type="text" class="form-control" placeholder="Product Name">
                <span id="p_name-error">
                @error('p_name')
                    {{$message}}
                    @enderror
            </span>
                <br><input type="text" name="p_price" id="p_price" class="form-control" placeholder="Product Price">
                <span id="p_price-error"></span>
                @error('p_price')
                {{$message}}
                @enderror

                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
                <span id="category_id-error">
                    @error('category_id')
                    {{ $message }}
                    @enderror
                 </span>
                <br>
                <div class="fileupload">

                    <input class="form-control fileinput-button" type="file" name="product-img" id="product-img" class="form-control" required/>

                </div>
                <span id="product-img-error"></span>
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
            $('#createProductForm').on('submit', function(e) {
                e.preventDefault(); // Prevent normal form submission

                var formData = new FormData(this); // Gather all form data, including files

                $.ajax({
                    url: "{{route('create-product') }}", // The route for the controller action
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

                            $('#p_name-error').text(errors.p_price ? errors.p_name[0] : '');
                            $('#p_price-error').text(errors.category_id ? errors.p_price[0] : '');
                            $('#category_id-error').text(errors.category_id ? errors.category_id[0] : '');
                            $('#product-img-error').text(errors['product-img'] ? errors['product-img'][0] : '');
                        } else {
                            alert("Unexpected error: " + xhr.responseText);
                            console.error("Full error details:", xhr);
                        }
                    }
                    // error: function(xhr) {
                    //     // Handle validation errors
                    //     $('#p_name-error').text(xhr.responseJSON.errors.fullname ? xhr.responseJSON.errors.fullname[0] : '');
                    //     $('#p_price-error').text(xhr.responseJSON.errors.email ? xhr.responseJSON.errors.email[0] : '');
                    //     $('#category_id-error').text(xhr.responseJSON.errors.pswd ? xhr.responseJSON.errors.pswd[0] : '');
                    //     $('#product-img-error').text(xhr.responseJSON.errors['profile-img'] ? xhr.responseJSON.errors['profile-img'][0] : '');
                    // }
                });
            });
        });
    </script>
@endsection

