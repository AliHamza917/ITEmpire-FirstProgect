@extends('layouts.default')
@section('container')
    <section>
        <div class="container">

            <form class="form-signin" id="editProductForm" enctype="multipart/form-data">
{{--            <form class="form-signin" method="post" action="{{route('UpdateProduct', $product->id)}}" enctype="multipart/form-data">--}}
                @csrf
                <h2 class="form-signin-heading">Edit Product</h2>
                <div class="login-wrap">
                    <input name="p_name" id="p_name" type="text" value="{{$product->product_name}}" class="form-control" placeholder="Product Name">
                    <span>
                        @error('p_name')
                            {{$message}}
                        @enderror
                    </span>
                    <br>
                    <input name="p_price"id="p_price" type="text" value="{{$product->product_price}}" class="form-control" placeholder="Product Price">
                    <span>
                        @error('p_price')
                        {{$message}}
                        @enderror
                    </span>

                    <div class="fileupload">

                        <input class="form-control fileinput-button" type="file" name="product-img" id="product-img" class="form-control" />

                    </div>
                    @error('product-img')
                    {{ $message }}
                    @enderror
                    <br>

                    <button class="btn btn-md btn-login btn-block" type="submit">Update Product</button>



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
            $('#editProductForm').on('submit', function(e) {
                e.preventDefault(); // Prevent normal form submission

                var formData = new FormData(this); // Gather all form data, including files

                $.ajax({
                    url: "{{ route('UpdateProduct', $product->id) }}", // The route for the controller action
                    method: 'POST',
                    data: formData,
                    processData: false,  // Don't let jQuery process the form data
                    contentType: false,  // Don't set content-type (for file uploads)
                    success: function(response) {
                        if(response.success) {
                            alert('Manager created successfully');
                            window.location.href = "{{ route('ProductsTable') }}"; // Redirect after success
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                    },
                    error: function(xhr) {
                        // Handle validation errors
                        $('#p_name-error').text(xhr.responseJSON.errors.fullname ? xhr.responseJSON.errors.p_name[0] : '');
                        $('#p_price-error').text(xhr.responseJSON.errors.email ? xhr.responseJSON.errors.p_price[0] : '');
                        $('#category_id-error').text(xhr.responseJSON.errors.pswd ? xhr.responseJSON.errors.category_id[0] : '');
                        $('#product-img-error').text(xhr.responseJSON.errors['profile-img'] ? xhr.responseJSON.errors['product-img'][0] : '');
                    }
                });
            });
        });
    </script>
@endsection

