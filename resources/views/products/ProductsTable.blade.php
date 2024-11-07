@php $index= 1; @endphp
@extends('layouts.default')
@section('container')
    <section class="panel">
        <h1>Products Table</h1>
        <div class="panel-body">

            <!-- **Added Form for Category Selection** -->
            <form method="GET" action="{{ route('ProductsTable') }}">
               <div class="" style="display: flex; gap: 10px;">
                   <div class="form-group col-6">
                       <label for="category_id">Select Category</label>
                       <select name="category_id" class="form-control" onchange="this.form.submit()">
                           <option value="">All Categories</option>
                           @foreach($categories as $category)
                               <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                   {{ $category->category_name }}
                               </option>
                           @endforeach
                       </select>
                   </div>

                  @if(session('role')=== 'admin' || session('role')=== 'M')

                       <div class="form-group col-6">
                           <label for="u_id">Select User</label>
                           <select name="u_id" class="form-control" onchange="this.form.submit()">
                               <option value="">All Users</option>
                               @foreach($users as $user)
                                   <option value="{{ $user->id }}" {{ request('u_id') == $user->id ? 'selected' : '' }}>
                                       {{ $user->fullname }}
                                   </option>
                               @endforeach
{{--                               @foreach($products as $product)--}}
{{--                                   <option value="{{ $product->user->id }}">{{ $product->user->fullname}}</option>--}}
{{--                               @endforeach--}}
                           </select>
                       </div>

                   @endif

                   @if(session('role') === 'admin')
                       <div class="form-group col-6">
                           <label for="manager_id">Select Manager</label>
                           <select name="manager_id" class="form-control" onchange="this.form.submit()">
                               <option value="">All Managers</option>
                               @foreach($managers as $manager)
                                   <option value="{{ $manager->id }}" {{ request('manager_id') == $manager->id ? 'selected' : '' }}>
                                       {{ $manager->fullname }}
                                   </option>
                               @endforeach
                           </select>
                       </div>
                   @endif

{{--                   @if(session('role')=== 'admin')--}}

{{--                       <div class="form-group col-6">--}}
{{--                           <label for="manager_id">Select Manager</label>--}}
{{--                           <select name="manager_id" class="form-control" onchange="this.form.submit()">--}}
{{--                               <option value="">All Managers</option>--}}
{{--                               @foreach($users as $user)--}}
{{--                                   <option value="{{ $user->id }}" {{ request('u_id') == $user->id ? 'selected' : '' }}>--}}
{{--                                       {{ $user->fullname }}--}}
{{--                                   </option>--}}
{{--                               @endforeach--}}
{{--                               @foreach($products as $product)--}}
{{--                                   <option value="{{ $product->user->id }}">{{ $product->user->fullname}}</option>--}}
{{--                               @endforeach--}}
{{--                           </select>--}}
{{--                       </div>--}}

{{--                   @endif--}}
               </div>
            </form>
            <!-- **End of Form** -->

            <section id="unseen">
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Image</th>
                        <th>Category</th>
                        @if(session('role') === 'admin' || session('role')==='M')
                            <th>User Name</th>
                        @endif
                        @if(session('role')==='admin')
                            <th>Manager Name</th>
                        @endif
                        <th>Action</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)  <!-- **Changed 'product' to 'products' to match controller -->
                    <tr class="gradeX">
                        <td>{{ $index++ }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->product_price }}</td>
                        <td>

                            <img alt="NoImage" src="{{ asset('storage/product-image/'.$product->product_img) }}" width="50">
                            {{--                                    <img alt="NoImage" src="{{ storage_path('public/product-images/'$product->product_img) }}" width="50">--}}
                        </td>
                        <td>{{ $product->category->category_name}}</td>
                        @if(session('role')=== 'admin' || session('role')==='M')
                             <td>{{ $product->user->fullname}}</td>
                        @endif
                        @if(session('role')==='admin')
                            <td>{{ $manager->fullname }}</td>
                        @endif
                        <td>
                            <a class="btn btn-warning" href="{{('edit-product')}}/{{$product->id}}">Edit</a> &nbsp;
                            <a class="btn btn-danger" href="{{('del-product')}}/{{$product->id}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </section>
        </div>
    </section>
@endsection
