@php $index= 1;@endphp
@extends('layouts.default')
@section('container')
    <section class="panel">
<h1>Users Table</h1>
        <div class="panel-body">
            <!-- **Added Form for Manager Selection** -->
            @if(session('role') === 'admin')
                <form id="filterForm" >
                {{--            <form method="GET" id="filterForm" action="{{ route('ProductsTable') }}">--}}


                        <div class="form-group col-6" style="width: 30%">
                            <label for="manager_id">Select Manager</label>
                            <select name="manager_id" class="form-control" onchange="applyFilters()">
                                <option value="">All Users</option>
                                @foreach($managers as $manager)
                                        <option value="{{ $manager->id }}" {{ request('manager_id') == $manager->id ? 'selected' : '' }}>
                                            {{ $manager->fullname }}
                                        </option>

                                @endforeach
                            </select>
                        </div>



            </form>
            @endif
            <!-- **End of Form** -->
        </div>

            <section id="unseen">
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                    <tr>

                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>User Profile</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="userTableBody">

                    @include('users.partials.userTable', ['users' => $users]) <!-- Loaded initially with Users -->

                    </tbody>
                </table>
            </section>
        </div>
    </section>

@endsection
@section('scripts')

    {{--    Ajax Jquery Function Starts--}}

    <script>
        $(document).ready(function() {
            $('#filterForm').on('change', 'select[name="manager_id"]', function() {
                applyFilters();
            });
        });

        function applyFilters() {
            $.ajax({
                url: '{{ route("UserTable") }}', // Adjusted route if needed
                type: 'GET',
                data: $('#filterForm').serialize(), // Send serialized form data
                success: function(response) {
                    $('#userTableBody').html(response); // Update the table body with the new data
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        }
    </script>



{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>--}}
{{--    <script>--}}
{{--        function applyFilters() {--}}
{{--            $.ajax({--}}
{{--                url: '{{ route("UserTable") }}',--}}
{{--                type: 'GET',--}}
{{--                data: $('#filterForm').serialize(), // Send form data--}}
{{--                success: function(response) {--}}
{{--                    $('#userTableBody').html(response); // Update the table body--}}
{{--                },--}}
{{--                error: function(xhr, status, error) {--}}
{{--                    console.error("AJAX Error:", error);--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}
{{--    </script>--}}

    {{--    Ajax Jquery Function Ends--}}

@endsection
