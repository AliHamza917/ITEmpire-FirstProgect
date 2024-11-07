@extends('layouts.default')
@section('container')
    <div class="container">

{{--        {{dd($users)}}--}}

        <form class="form-signin" method="post" action="{{ route('addProductByAdmin') }}" enctype="multipart/form-data">
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
                <select name="m_id" class="form-control" required>
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


                <select name="user_id" class="form-control" required>
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
