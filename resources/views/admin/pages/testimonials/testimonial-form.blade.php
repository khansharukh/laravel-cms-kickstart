<?php
/**
 * Created by PhpStorm.
 * User: khan_
 * Date: 3/6/2018
 * Time: 2:42 PM
 */
?>
@extends('admin.templates.default')
@section('title', 'Dashboard')
@section('content')
    <?php
    $bool = !empty($testimonial) ? true : false;
    $title = $bool ? 'Edit Testimonial' : 'Add Testimonial';
    ?>

    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <h5>{{ $title }}</h5>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <form action="{{ $bool ? route('admin.testimonial.update') : route('admin.testimonial.insert') }}" method="POST" enctype='multipart/form-data'>
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <input type="hidden" name="_id" value="{{ $bool ? $testimonial[0]->id : '' }}">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" id="" required
                                   placeholder="Enter name" value="{{ $bool ? $testimonial[0]->name : '' }}" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Select Ratings</label>
                            <select name="ratings" required class="form-control">
                                <option {{ $bool && $testimonial[0]->ratings == '1' ? 'selected' : '' }} value="1">1</option>
                                <option {{ $bool && $testimonial[0]->ratings == '2' ? 'selected' : '' }} value="2">2</option>
                                <option {{ $bool && $testimonial[0]->ratings == '3' ? 'selected' : '' }} value="3">3</option>
                                <option {{ $bool && $testimonial[0]->ratings == '4' ? 'selected' : '' }} value="4">4</option>
                                <option {{ $bool && $testimonial[0]->ratings == '5' ? 'selected' : '' }} value="5">5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Comments</label>
                            <textarea class="form-control" name="comments" id="" required
                                      placeholder="Enter comment">{{ $bool ? $testimonial[0]->comment : '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Picture</label>
                            <input type="file" name="filename" {{ $bool ? '' : 'required' }} />
                            <?php if($bool) {?>
                            <input type="hidden" name="e_file" value="{{ $bool ? $testimonial[0]->image : '' }}" />
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Status</label>
                            <div class="form-inline">
                                <label><input type="radio" name="status" value="0"> Inactive</label> &nbsp;&nbsp;&nbsp;&nbsp;
                                <label><input type="radio" name="status" value="1" checked> Active</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop