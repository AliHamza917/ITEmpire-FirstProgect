@php $index= 1;@endphp
@extends('layouts.default')
@section('container')
    <section class="panel">
<h1>Users Table</h1>
        <div class="panel-body">

            <!-- **Added Form for Manager Selection** -->
            <form id="filterForm" >
                {{--            <form method="GET" id="filterForm" action="{{ route('ProductsTable') }}">--}}

                    @if(session('role') === 'admin')
                        <div class="form-group col-6" style="width: 30%">
                            <label for="manager_id">Select Manager</label>
                            <select name="manager_id" class="form-control" onchange="this.form.submit()">
                                <option value="">All Users</option>
                                @foreach($managers as $manager)
                                        <option value="{{ $manager->id }}" {{ request('manager_id') == $manager->id ? 'selected' : '' }}>
                                            {{ $manager->fullname }}
                                        </option>

                                @endforeach
                            </select>
                        </div>
                    @endif

                </div>
            </form>
            <!-- **End of Form** -->


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

                    @include('users.partials.userTable', ['users' => $users]) <!-- Loaded initially with products -->

                    {{--                    @foreach($users as $user)--}}
{{--                        --}}{{--        {{dd($users)}}--}}
{{--                        @if($user->user_role === 'admin')--}}

{{--                        @else--}}
{{--                            <tr class="gradeX">--}}
{{--                                <td>{{$index++}}</td>--}}
{{--                                <td>{{$user->fullname}}</td>--}}
{{--                                <td>{{$user->email}}</td>--}}
{{--                                <td>--}}
{{--                                    @if($user->user_role === 'M')--}}
{{--                                        Manager--}}
{{--                                    @else--}}
{{--                                        User--}}
{{--                                    @endif--}}

{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <img alt="NoImage" src="{{ asset('storage/profile-image/'.$user->profile_img) }}" width="50">--}}
{{--                                    </td>--}}
{{--                                <td>--}}
{{--                                    @if($user->user_role === 'admin')--}}
{{--                                        <h4>Admin</h4>--}}
{{--                                    @else--}}

{{--                                        @if($user->status === '0')--}}
{{--                                            Rejected--}}
{{--                                        @else--}}
{{--                                            Approved--}}
{{--                                        @endif--}}

{{--                                    @endif--}}

{{--                                </td>--}}


{{--                                <td>--}}


{{--                                    @if($user->status === '0')--}}
{{--                                        <a class="btn btn-success" href="{{('UpdateStatus')}}/{{$user->id}}">Approve</a>--}}
{{--                                    @else--}}
{{--                                        <a class="btn btn-danger" href="{{('UpdateStatus')}}/{{$user->id}}">Reject</a>--}}
{{--                                    @endif--}}

{{--                                </td>--}}

{{--                                Make Manager Or User--}}

{{--                                @if(session('role') === 'admin')--}}

{{--                                        <td>--}}

{{--                                            @if($user->user_role === 'M')--}}
{{--                                                <a class="btn btn-danger " href="{{('update-role')}}/{{$user->id}}">Make User</a>--}}
{{--                                            @else--}}
{{--                                                <a class="btn btn-success " href="{{('update-role')}}/{{$user->id}}">Make Manager</a>--}}
{{--                                            @endif--}}


{{--                                        </td>--}}
{{--                                @endif--}}


{{--                        @endif--}}

{{--                    @endforeach--}}

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
