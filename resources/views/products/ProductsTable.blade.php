@php $index= 1; @endphp
@extends('layouts.default')
@section('container')
    <section class="panel">
{{--        {{dd($Allusers)}}--}}
        <h1>Products Table</h1>
        <div class="panel-body">

            <!-- **Added Form for Category Selection** -->
            <form id="filterForm" >
{{--            <form method="GET" id="filterForm" action="{{ route('ProductsTable') }}">--}}
               <div class="" style="display: flex; gap: 10px;">
                   <div class="form-group col-6">
                       <label for="category_id">Select Category</label>
                       <select name="category_id" class="form-control" onchange="applyFilters()">
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
                           <select name="u_id" class="form-control" onchange="applyFilters()">
                               <option value="">All Users</option>
                               @foreach($Allusers as $user)
                                   @if($user->user_role === 'user')
                                       <option value="{{ $user->id }}" {{ request('u_id') == $user->id ? 'selected' : '' }}>
                                           {{ $user->fullname }}
                                       </option>
                                   @endif
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
                           <select name="manager_id" class="form-control" onchange="applyFilters()">
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
{{--                        @if(session('role')==='admin')--}}
{{--                            <th>Manager Name</th>--}}
{{--                        @endif--}}
                        <th>Action</th>


                    </tr>
                    </thead>
                    <tbody id="productsTableBody">

                    @include('products.partials.productsTable', ['products' => $products]) <!-- Loaded initially with products -->

                    </tbody>
                </table>
            </section>
        </div>
    </section>

{{--    Ajax Jquery Function Starts--}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#filterForm select').on('change', function() {
                applyFilters();
            });
        });

        function applyFilters() {
            $.ajax({
                url: '{{ route("ProductsTable") }}',
                type: 'GET',
                data: $('#filterForm').serialize(), // Send serialized form data
                success: function(response) {
                    $('#productsTableBody').html(response); // Update the table body

                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                    console.error("Details:", xhr.responseText); // Log the response for debugging
                }
            });
        }

    </script>



@endsection
