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
@section('title', 'Product details')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    <style>
        .slider-nav img {
            font-size: 36px;
            line-height: 100px;
            margin: 10px;
            padding: 1%;
            max-width: 150px;
            position: relative;
            text-align: center;
            max-height: 80px;
            min-height: 80px;
            overflow: hidden;
        }
    </style>
    <?php
    $bool = !empty($product[0]->id) ? true : false;
    ?>
    <!-- Content -->
    <div class="page-content bg-white">
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row" style="padding: 2px 0;">
            <div class="container">
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <div class="content-area">
            <div class="container woo-entry">
                <div class="row m-b30">
                    <div class="blog-post blog-md date-style-2">
                        <div class="col-md-6 col-sm-6 m-b30">
                            @if(!empty($images))
                                <div class="{{ count($images) > 1 ? 'slider-for' : '' }}">
                                    @foreach($images AS $image)
                                        <div class="item">
                                            <img src="{{ asset('uploads/products').'/'.$image->filename }}"
                                                 class="img-responsive"/>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if(!empty($images))
                                @if(count($images) > 1)
                                    <div class="slider-nav">
                                        @foreach($images AS $image)
                                            <div class="item">
                                                <img src="{{ asset('uploads/products').'/'.$image->filename }}"/>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="dez-post-title ">
                                <h2 class="post-title" style="font-size: 34px; margin-bottom: 0">
                                    {{ $bool ? $product[0]->title : '' }}
                                </h2>
                            </div>
                            <h2 class="m-tb10">${{ $bool ? $product[0]->price : '' }}</h2>
                            <div class="dez-post-text">
                                <p class="m-b10">
                                    {{ $bool ? $product[0]->description : '' }}
                                </p>
                            </div>
                            <table class="table table-bordered">
                                <tr>
                                    <td>Color</td>
                                    <td>{{ $bool ? $product[0]->color : '' }}</td>
                                </tr>
                                <tr>
                                    <td>Size</td>
                                    <td>{{ $bool ? $product[0]->size : '' }}</td>
                                </tr>
                                <tr>
                                    <td>Unit</td>
                                    <td>{{ $bool ? $product[0]->unit : '' }}</td>
                                </tr>
                                <tr>
                                    <td>Quantity</td>
                                    <td>{{ $bool ? $product[0]->quantity : '' }}</td>
                                </tr>
                                <tr>
                                    <td>Packaging</td>
                                    <td>{{ $bool ? $product[0]->packaging : '' }}</td>
                                </tr>
                                <tr>
                                    <td>Grade</td>
                                    <td>{{ $bool ? $product[0]->grade : '' }}</td>
                                </tr>
                                <tr>
                                    <td>QR Code</td>
                                    <td>
                                        <img src="{{ asset('uploads/products/qr').'/'.$product[0]->qr_code }}"/>
                                    </td>
                                </tr>
                            </table>
                            <form method="post" class="cart">
                                <div class="quantity btn-quantity pull-left m-r10">
                                    <input id="demo_vertical2" type="text" value="1" name="demo_vertical2"/>
                                </div>
                                <button class="btn btn-primary site-button pull-left"><i class="fa fa-cart-plus"></i>
                                    Add To
                                    Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content END-->
    </div>
@stop
@section('internal-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: true,
            centerMode: true,
            focusOnSelect: true
        });
    </script>
@stop