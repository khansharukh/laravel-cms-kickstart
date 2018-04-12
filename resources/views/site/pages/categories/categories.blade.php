<?php
/**
 * Created by PhpStorm.
 * User: Khan
 * Date: 8/7/2017
 * Time: 6:55 AM
 */
use \App\Http\Controllers\Controller;
?>
<?php
$controller = new Controller();
?>
@extends('site.templates.default')
@section('title', 'Categories')
@section('content')
    <?php
    $categories = $controller->selectFunction('categories', array('id', 'title', 'image'), '');
    ?>

    <style>

    </style>
    <!-- Content -->
    <div class="page-content">
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="{{ route('web.home') }}">Home</a></li>
                    <li>Categories</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <!-- contact area -->
        <div class="content-inner section-full bg-white">
            <div class="container">
                <?php
                //Columns must be a factor of 12 (1,2,3,4,6,12)
                $numOfCols = 3;
                $rowCount = 0;
                $bootstrapColWidth = 12 / $numOfCols;
                ?>
                <div class="row m-b40">
                    <?php
                    foreach ($categories as $category){
                        $wheres = [
                            'category_id' => $category->id,
                            'status' => '1'
                        ];
                        $product_count = $controller->selectFunction('products', array('id'), $wheres);
                    ?>
                    <div class="col-md-<?php echo $bootstrapColWidth; ?> m-b30 max-height-class">
                        <div class="dez-box add-product">
                            <div class="dez-media dez-img-effect"><img
                                        src="{{ asset('uploads/category').'/'.$category->image }}"
                                        alt="">
                                <div class="dez-info-has p-a20 bg-black no-hover">
                                    <h3 class="m-t10">{{ $category->title }}</h3>
                                    <h2 class="">{{ count($product_count) }} Products</h2>
                                    <a href="{{ route('web.category.products', ['id' => $category->id, 'title' => str_slug($category->title, '-')]) }}" class="site-button text-uppercase">SHOW ALL</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $rowCount++;
                    if ($rowCount % $numOfCols == 0) echo '</div><div class="row m-b40">';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
@stop