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
            <h4>Social media profile</h4>
        </div>
        <form action="{{ route('admin.social.update') }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_id" id="e_id" value="{{ !empty($result[0]->id) ? $result[0]->id : '' }}">
            <div class="form-group">
                <label>Twitter link</label>
                <input type="url" class="form-control" name="twitter" placeholder="Please start link with http"
                       value="{{ !empty($result[0]->twitter) ? $result[0]->twitter : '' }}" required/>
            </div>
            <div class="form-group">
                <label>Facebook profile/page link</label>
                <input type="url" class="form-control" name="facebook" placeholder="Please start link with http"
                       value="{{ !empty($result[0]->facebook) ? $result[0]->facebook : '' }}" required/>
            </div>
            <div class="form-group">
                <label>Instagram profile link</label>
                <input type="url" class="form-control" name="instagram" placeholder="Please start link with http"
                       value="{{ !empty($result[0]->instagram) ? $result[0]->instagram : '' }}" required/>
            </div>
            <div class="form-group">
                <label>Google plus profile link</label>
                <input type="url" class="form-control" name="google" placeholder="Please start link with http"
                       value="{{ !empty($result[0]->google) ? $result[0]->google : '' }}" required/>
            </div>
            <div class="form-group">
                <label>LinkedIn business link</label>
                <input type="url" class="form-control" name="linkedin" placeholder="Please start link with http"
                       value="{{ !empty($result[0]->linkedin) ? $result[0]->linkedin : '' }}" required/>
            </div>
            <div class="form-group">
                <label>Pinterest profile link</label>
                <input type="url" class="form-control" name="pinterest" placeholder="Please start link with http"
                       value="{{ !empty($result[0]->pinterest) ? $result[0]->pinterest : '' }}" required/>
            </div>
            <button type="submit" class="btn btn-primary" id="btn-text">Update social links</button>
        </form>
    </div>
@stop