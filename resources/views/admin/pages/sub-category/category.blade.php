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
            <h4>Sub-Categories</h4>
        </div>
        <div class="table-responsive">
            @if($categories)
                <table class="table table-bordered">
                    <tr>
                        <th>Sr no</th>
                        <th>Category</th>
                        <th>Sub-Category</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    @foreach($categories AS $category)
                        <?php
                        $cat_name = DB::table('categories')
                            ->select('title')
                            ->where('id', $category->cat_id)
                            ->get();
                        ?>
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $cat_name[0]->title }}</td>
                            <td>{{ $category->s_title }}</td>
                            <td>{{ $category->s_image }}</td>
                            <td>
                                <a href="{{ route('admin.sub_category.edit', ['id' => $category->id]) }}">Edit</a> |
                                <a href="javascript:void(0)" id="delete-id"
                                   onclick="deleteMethod('{{ $category->id }}', '{{ $category->s_image }}');">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
@stop
<form action="{{ route('admin.sub_category.delete') }}" id="delete-form" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_id" value="" id="_id">
    <input type="hidden" name="file" value="" id="file">
</form>
@section('internal-scripts')
    <script>
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