@php $index= 1;@endphp
@extends('layouts.default')
@section('container')
    <section class="panel">
<h1>Users Table</h1>
        <div class="panel-body">
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
                    <tbody>
                    @foreach($users as $user)
                        {{--        {{dd($users)}}--}}
                        @if($user->user_role === 'admin')

                        @else
                            <tr class="gradeX">
                                <td>{{$index++}}</td>
                                <td>{{$user->fullname}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if($user->user_role === 'M')
                                        Manager
                                    @else
                                        User
                                    @endif

                                </td>
                                <td>
                                    <img alt="NoImage" src="{{ asset('storage/profile-image/'.$user->profile_img) }}" width="50">
                                    </td>
                                <td>
                                    @if($user->user_role === 'admin')
                                        <h4>Admin</h4>
                                    @else

                                        @if($user->status === '0')
                                            Rejected
                                        @else
                                            Approved
                                        @endif

                                    @endif

                                </td>


                                <td>


                                    @if($user->status === '0')
                                        <a class="btn btn-success" href="{{('UpdateStatus')}}/{{$user->id}}">Approve</a>
                                    @else
                                        <a class="btn btn-danger" href="{{('UpdateStatus')}}/{{$user->id}}">Reject</a>
                                    @endif

                                </td>

{{--                                Make Manager Or User--}}

                                @if(session('role') === 'admin')

                                        <td>

                                            @if($user->user_role === 'M')
                                                <a class="btn btn-danger " href="{{('update-role')}}/{{$user->id}}">Make User</a>
                                            @else
                                                <a class="btn btn-success " href="{{('update-role')}}/{{$user->id}}">Make Manager</a>
                                            @endif


                                        </td>
                                @endif


                        @endif

                    @endforeach

                    </tbody>
                </table>
            </section>
        </div>
    </section>

@endsection
