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
    <?php
    $logged_array = Session::get('admin_array');
    $log_id = $logged_array[0]->id;
    ?>
    <div class="panel">
        <div class="card-header m-b-15">
            <h4>Admin profile</h4>
        </div>
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_id" id="e_id" value="{{ $log_id }}">
            <div class="form-group">
                <label>Admin name</label>
                <input type="text" class="form-control" name="name" id="_title" placeholder=""
                       value="{{ !empty($result[0]->name) ? $result[0]->name : '' }}" required/>
            </div>
            <div class="form-group">
                <label>Admin email</label>
                <input type="email" class="form-control" name="email" id="_title" placeholder=""
                       value="{{ !empty($result[0]->email) ? $result[0]->email : '' }}" required/>
            </div>
            <button type="submit" class="btn btn-primary" id="btn-text">Update profile</button>
        </form>
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