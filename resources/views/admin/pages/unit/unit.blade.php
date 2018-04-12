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
            <h4>Units</h4>
        </div>
        <form action="{{ route('admin.unit.action') }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_id" id="e_id">
            <div class="form-group">
                <label>Unit title</label>
                <input type="text" class="form-control" name="title" id="_title" placeholder="Eg; kg, litre, ton etc"
                       value="" required/>
            </div>
            <button type="submit" class="btn btn-primary" id="btn-text">Add Unit</button>
        </form>
        <div class="table-responsive">
            @if($units)
                <table class="table table-bordered">
                    <tr>
                        <th>Sr no</th>
                        <th>Unit</th>
                        <th>Action</th>
                    </tr>
                    @foreach($units AS $unit)
                        <tr>
                            <td>{{ $unit->id }}</td>
                            <td>{{ $unit->title }}</td>
                            <td>
                                <a href="javascript:void(0)" id="delete-id"
                                   onclick="editMethod('{{ $unit->id }}', '{{ $unit->title }}');">Edit</a> |
                                <a href="javascript:void(0)" id="delete-id"
                                   onclick="deleteMethod('{{ $unit->id }}', '');">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
@stop
<form action="{{ route('admin.unit.delete') }}" id="delete-form" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_id" value="" id="_id">
    <input type="hidden" name="file" value="" id="file">
</form>
@section('internal-scripts')
    <script>
        function editMethod(id, title) {
            $('#e_id').val(id);
            $('#_title').val(title);
            $('#btn-text').text('Update');
        }

        function deleteMethod(id, image) {
            var conf = confirm("Are you sure you want to delete this?");
            if (conf == true) {
                $('#_id').val(id);
                $('#file').val(image);
                $('#delete-form').submit();
            }
            return false;
        }
    </script>
@stop