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
            <h4>Suppliers</h4>
        </div>
        <div class="table-responsive">
            @if($suppliers)
                <table class="table table-bordered">
                    <tr>
                        <th>Sr no</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    @foreach($suppliers AS $supplier)
                        <tr>
                            <td>{{ $supplier->id }}</td>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->email }}</td>
                            <td>
                                <a href="javascript:void(0)" onclick="deleteMethod('{{ $supplier->id }}', '');">Approve</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
        <div class="card-header m-b-15">
            <h4>Approved Suppliers</h4>
        </div>
        <div class="table-responsive">
            @if($approved)
                <table class="table table-bordered">
                    <tr>
                        <th>Sr no</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                    @foreach($approved AS $app)
                        <tr>
                            <td>{{ $app->id }}</td>
                            <td>{{ $app->name }}</td>
                            <td>{{ $app->email }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
@stop
<form action="{{ route('admin.suppliers.update') }}" id="delete-form" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_id" value="" id="_id">
</form>
@section('internal-scripts')
    <script>
        function deleteMethod(id, image) {
            var conf = confirm("Are you sure you want to approve this member?");
            if (conf == true) {
                $('#_id').val(id);
                $('#file').val(image);
                $('#delete-form').submit();
            }
            return false;
        }
    </script>
@stop