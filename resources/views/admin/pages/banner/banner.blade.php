<?php
/**
 * Created by PhpStorm.
 * User: Khan
 * Date: 8/7/2017
 * Time: 6:55 AM
 */
?>
@extends('admin.templates.default')
@section('title', 'Dashboard')
@section('content')
    <div class="panel">
        <div class="card-header m-b-15">
            <h4>Banners</h4>
        </div>
        <div class="table-responsive">
            @if($banners)
                <table class="table table-bordered">
                    <tr>
                        <th>Sr no</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    @foreach($banners AS $banner)
                        <tr>
                            <td>{{ $banner->id }}</td>
                            <td>{{ $banner->cap_title }}</td>
                            <td>{{ $banner->filename }}</td>
                            <td>
                                <a href="{{ route('admin.banner.edit', ['id' => $banner->id]) }}">Edit</a> |
                                <a href="javascript:void(0)" id="delete-id" onclick="deleteMethod('{{ $banner->id }}', '{{ $banner->filename }}');">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
@stop
<form action="{{ route('admin.banner.delete') }}" id="delete-form" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_id" value="" id="_id">
    <input type="hidden" name="file" value="" id="file">
</form>
@section('internal-scripts')
    <script>
        function deleteMethod(id, image) {
            var conf = confirm("Are you sure you want to delete this?");
            console.log(conf);
            if (conf == true) {
                $('#_id').val(id);
                $('#file').val(image);
                $('#delete-form').submit();
            }
            return false;
        }
    </script>
@stop