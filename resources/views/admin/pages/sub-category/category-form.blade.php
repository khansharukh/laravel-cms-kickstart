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
    $bool = !empty($category) ? true : false;
    $title = $bool ? 'Edit Sub-Category' : 'Add Sub-Category';
    ?>
    <div class="panel">
        <div class="card-header m-b-15">
            <h4>{{ $title }}</h4>
        </div>
        <form action="{{ $bool ? route('admin.sub_category.update') : route('admin.sub_category.insert') }}"
              method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_id" value="{{ $bool ? $category[0]->id : '' }}">
            <div class="form-group">
                <label>Categories</label>
                <select name="cat_id" class="form-control" required>
                    <option value="">Select category</option>
                    @if(!empty($categories))
                        @foreach($categories AS $cat)
                            <option value="{{ $cat->id }}" {{ $bool && $category[0]->cat_id == $cat->id ? 'selected' : '' }}>{{ $cat->title }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="s_title" placeholder="Enter title here"
                       value="{{ $bool ? $category[0]->s_title : '' }}" required/>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" class="form-control" name="s_image" {{ $bool ? '' : 'required' }} />
                <?php if($bool) {?>
                <input type="hidden" name="e_file" value="{{ $bool ? $category[0]->s_image : '' }}"/>
                <?php } ?>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@stop