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
    $bool = !empty($banner) ? true : false;
    $title = $bool ? 'Edit Banner' : 'Add Banner';
    ?>
    <div class="panel">
        <div class="card-header m-b-15">
            <h4>{{ $title }}</h4>
        </div>
        <form action="{{ $bool ? route('admin.banner.update') : route('admin.banner.insert') }}" method="POST"
              enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_id" value="{{ $bool ? $banner[0]->id : '' }}">
            <div class="form-group">
                <label>Caption Title</label>
                <input type="text" class="form-control" name="cap_title" placeholder="Enter caption title here"
                       value="{{ $bool ? $banner[0]->cap_title : '' }}" required/>
            </div>
            <div class="form-group">
                <label>Caption</label>
                <input type="text" class="form-control" name="caption" placeholder="Enter caption here"
                       value="{{ $bool ? $banner[0]->caption : '' }}" required/>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" class="form-control" name="filename" {{ $bool ? '' : 'required' }} />
                <?php if($bool) {?>
                <input type="hidden" name="e_file" value="{{ $bool ? $banner[0]->filename : '' }}"/>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Permalink </label>
                <input type="text" class="form-control" id="" value="{{ $bool ? $banner[0]->link : '' }}" name="link"
                       placeholder="Please start your link with http://">
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Link Target</label>
                <select name="target" class="form-control" id="">
                    <option value="">Select target</option>
                    <option value="_blank" {{ $bool && $banner[0]->target == '_blank' ? 'selected' : '' }}>_blank - Open
                        Link in new tab
                    </option>
                    <option value="_self" {{ $bool && $banner[0]->target == '_self' ? 'selected' : '' }}>_self - Open
                        Link in same tab
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="">Select status</option>
                    <option value="1" {{ $bool && $banner[0]->status == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $bool && $banner[0]->status == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@stop