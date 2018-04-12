<?php
/**
 * Created by PhpStorm.
 * User: Khan
 * Date: 8/7/2017
 * Time: 6:55 AM
 */
?>
@extends('admin.templates.default')
@section('title', 'Admin login')
@section('content')
    <div class="container">
        <div class="card card-login mx-auto mt-5">
            @if (Session('user_error'))
                <div class="alert alert-success">
                    {{ Session('user_error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-header">Admin Login - Laravel CMS</div>
            <div class="card-body">
                <form action="{{ route('admin.auth') }}" method="post">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email"
                               value="{{ Request::old('email') ?: '' }}"/>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password"/>
                    </div>
                    {{--<div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" name="remember" class="form-check-input">
                                Remember Password
                            </label>
                        </div>
                    </div>--}}
                    <input type="submit" class="btn btn-primary btn-block" name="submit" value="Login">
                </form>
            </div>
        </div>
    </div>
@stop

@section('internal-scripts')
<script>
    //events
</script>
@stop