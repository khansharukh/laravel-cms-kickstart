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
            <h4>Contact details</h4>
        </div>
        <div class="table-responsive">
            @if($contacts)
                <table class="table table-bordered">
                    <tr>
                        <th>Sr no</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    @foreach($contacts AS $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->address }}</td>
                            <td>
                                <a href="{{ route('admin.contact.edit', ['id' => $contact->id]) }}">Edit</a> |
                                <a href="javascript:void(0)" id="delete-id"
                                   onclick="deleteMethod('{{ $contact->id }}', '');">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
@stop
<form action="{{ route('admin.contact.delete') }}" id="delete-form" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_id" value="" id="_id">
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