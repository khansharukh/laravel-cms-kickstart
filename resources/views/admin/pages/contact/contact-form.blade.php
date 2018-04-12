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
    $bool = !empty($contact) ? true : false;
    $title = $bool ? 'Edit Contact' : 'Add Contact';
    ?>
    <div class="panel">
        <div class="card-header m-b-15">
            <h4>{{ $title }}</h4>
        </div>
        <form action="{{ $bool ? route('admin.contact.update') : route('admin.contact.insert') }}" method="POST"
              enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_id" value="{{ $bool ? $contact[0]->id : '' }}">
            <div class="form-group">
                <label>Phone</label>
                <input type="text" class="form-control" name="phone" placeholder="Enter phone number here"
                       value="{{ $bool ? $contact[0]->phone : '' }}" required/>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email id here"
                       value="{{ $bool ? $contact[0]->email : '' }}" required/>
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea class="form-control" name="address" placeholder="Enter new address">{{ $bool ? $contact[0]->address : '' }}</textarea>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="">Select status</option>
                    <option value="1" {{ $bool && $contact[0]->status == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $bool && $contact[0]->status == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@stop