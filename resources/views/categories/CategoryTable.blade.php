@php $index= 1;@endphp
@extends('layouts.default')
@section('container')
    <section class="panel">
<h1>Categories Table</h1>
        <div class="panel-body">
            <section id="unseen">
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                    <tr>

                        <th>ID</th>
                        <th>Category Name</th>
                        @if(session('role') === 'admin')
                            <th>Action</th>
                        @endif



                    </tr>
                    </thead>
                    <tbody>
                    @foreach($category as $categories)
                        {{--        {{dd($users)}}--}}
                        <tr class="gradeX">
                            <td>{{$index++}}</td>
                            <td>{{$categories->category_name}}</td>
                            @if(session('role') === 'admin')
                                <td> <a class="btn btn-warning" href="{{('edit-category')}}/{{$categories->id}}">Edit</a> &nbsp;
                                    <a class="btn btn-danger" href="{{('DelCategory')}}/{{$categories->id}}">Delete</a></td>

                            @endif

                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </section>
        </div>
    </section>

@endsection
