@extends('layouts.default')
@section('container')

    <section>
        <div class="container">

            <form class="form-signin" method="post" action="{{route('UpdateProfile' , Auth::user()->id)}}" enctype="multipart/form-data">
{{--            <form class="form-signin" method="post" action="{{route('UpdateProduct', $product->id)}}" enctype="multipart/form-data">--}}
                @csrf
                <h2 class="form-signin-heading">Upload Profile Pic</h2>
                <div class="login-wrap">

                    <div class="fileupload">

                        <input class="form-control fileinput-button" type="file" name="profile-img" class="form-control" />

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
