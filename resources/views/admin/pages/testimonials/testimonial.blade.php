<?php
/**
 * Created by PhpStorm.
 * User: khan_
 * Date: 3/6/2018
 * Time: 2:40 PM
 */
?>
@extends('admin.templates.default')
@section('title', 'Dashboard')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <h5>Testimonial</h5>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.testimonial.add') }}" class="btn btn-primary pull-right mb-2">Add testimonial</a>
                </div>
            </div>


            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

            @if (!$testimonials->count())
                <p>No Testimonials</p>
            @else
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-table"></i>
                        Testimonials
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <th>Sr. No.</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th hidden>Ratings</th>
                                <th>Comments</th>
                                <th>Status</th>
                                <th>Action</th>
                                </thead>
                                <tbody>
                                @foreach($testimonials AS $testimonial)
                                    <tr>
                                        <td>{{ $testimonial->id }}</td>
                                        <td>{{ $testimonial->name }}</td>
                                        <td><img src="{{ asset('uploads/testimonials/'.$testimonial->image) }}" style="width: 100px;" alt=""></td>
                                        <td hidden>{{ $testimonial->ratings }}</td>
                                        <td>{{ $testimonial->comment }}</td>
                                        <td>
                                            {{--@if($testimonial->status == '1')
                                                <a href="{{ route('dashboard.status', ['id' => $testimonial->id, 'table' => 'review', 'value' => '0']) }}">
                                                    Active </a>
                                            @else
                                                <a href="{{ route('dashboard.status', ['id' => $testimonial->id, 'table' => 'review', 'value' => '1']) }}">
                                                    Inactive </a>
                                            @endif--}}
                                        </td>
                                        <td><a href="{{ route('admin.testimonial.edit', ['id' => $testimonial->id]) }}"> Edit </a> | <a href="javascript:void(0)" id="delete-id" onclick="deleteMethod('{{ $testimonial->id }}', '{{ $testimonial->image }}');">Delete</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    @endif
@stop
<form action="{{ route('admin.testimonial.delete') }}" id="delete-form" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_id" value="" id="_id">
    <input type="hidden" name="file" value="" id="file">
</form>
@section('internal-scripts')
    <script>
        function deleteMethod(id, image) {
            var conf = confirm("Are you sure you want to delete this?");
            console.log(conf);
            if(conf == true) {
                $('#_id').val(id);
                $('#file').val(image);
                $('#delete-form').submit();
            }
            return false;
        }
    </script>
@stop