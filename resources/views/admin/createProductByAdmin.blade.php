@extends('layouts.default')
@section('container')
    <div class="container">

{{--        {{dd($users)}}--}}
{{--        {{dd($users)}}--}}

        <form class="form-signin" id="adminCreateProductForm" enctype="multipart/form-data">
{{--        <form class="form-signin" method="post" action="{{ route('addProductByAdmin') }}" enctype="multipart/form-data">--}}
            @csrf
            <h2 class="form-signin-heading">Add A Product</h2>
            <div class="login-wrap">
                <input name="p_name" type="text" class="form-control" placeholder="Product Name">
                <span>
                @error('p_name')
                    {{$message}}
                    @enderror
            </span>
                <br><input type="text" name="p_price" class="form-control" placeholder="Product Price">
                @error('p_price')
                {{$message}}
                @enderror

                <select name="category_id" class="form-control" required>
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
                <select name="m_id" id="managerSelect" class="form-control" required>
                    <option value="">Select Manager</option>
                    @foreach($users as $user)
                        @if($user->user_role === 'M')
                            <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                        @endif
                    @endforeach
                </select>
                <span>
            @error('m_id')
                    {{ $message }}
                    @enderror
        </span>
                <br>


                <select name="user_id" id="userSelect"  class="form-control" required>

                    <option value="">Select User</option>
                    @foreach($users as $user)
                        @if($user->user_role === 'user')
                            <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                        @endif
                    @endforeach
                </select>
                <span>
            @error('category_id')
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
            $('#adminCreateProductForm').on('submit', function(e) {
                e.preventDefault(); // Prevent normal form submission

                var formData = new FormData(this); // Gather all form data, including files

                $.ajax({
                    url: "{{route('addProductByAdmin') }}", // The route for the controller action
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


    <script>
        $(document).ready(function() {
            $('#managerSelect').on('change', function() {
                var managerId = $(this).val();
                $('#userSelect').empty(); // Clear the "Select User" dropdown

                if (managerId) {
                    $.ajax({
                        url: 'user-by-manager/' + managerId,
                        type: 'GET',
                        success: function(data) {
                            $('#userSelect').append('<option value="">Select User</option>');
                            $.each(data, function(index, m_user) {
                                $('#userSelect').append('<option value="' + m_user.id + '">' + m_user.fullname + '</option>');
                            });
                        },
                        error: function(xhr) {
                            console.error('An error occurred:', xhr);
                        }
                    });
                } else {
                    $('#userSelect').append('<option value="">Select User</option>');
                }
            });
        });
    </script>
@endsection
