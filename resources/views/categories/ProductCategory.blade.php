@extends('layouts.default')
@section('container')
    <section>
        <div class="container">

            <form class="form-signin" method="post" action="{{ route('create-category') }}">
                @csrf
                <h2 class="form-signin-heading">Add New Category</h2>
                <div class="login-wrap">
                    <input name="p_category" type="text" class="form-control" placeholder="Category Name">
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
