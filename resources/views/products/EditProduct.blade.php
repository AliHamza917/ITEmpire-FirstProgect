@extends('layouts.default')
@section('container')
    <section>
        <div class="container">

            <form class="form-signin" method="post" action="{{route('UpdateProduct', $product->id)}}" enctype="multipart/form-data">
                @csrf
                <h2 class="form-signin-heading">Edit Product</h2>
                <div class="login-wrap">
                    <input name="p_name" type="text" value="{{$product->product_name}}" class="form-control" placeholder="Product Name">
                    <span>
                        @error('p_name')
                            {{$message}}
                        @enderror
                    </span>
                    <br>
                    <input name="p_price" type="text" value="{{$product->product_price}}" class="form-control" placeholder="Product Price">
                    <span>
                        @error('p_price')
                        {{$message}}
                        @enderror
                    </span>

                    <div class="fileupload">

                        <input class="form-control fileinput-button" type="file" name="product-img" class="form-control" />

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
