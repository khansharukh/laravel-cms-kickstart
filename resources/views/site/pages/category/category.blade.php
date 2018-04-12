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
@section('title', !empty($category[0]->title) ? $category[0]->title : '')
@section('content')
    <?php
    $cat_id = !empty($category[0]->id) ? $category[0]->id : '';
    $wheres = [
        'category_id' => $cat_id
    ];
    $products = $controller->selectFunction('products', array('id', 'title', 'category_id', 'quantity', 'price', 'unit_id', 'status', 'grade_id', 'packaging_id', 'color', 'size', 'description', 'qr_code'), $wheres);
    ?>
    <style>
        .min-height-class {
            min-height: 150px;
            max-height: 150px;
            overflow: hidden;
        }

        .dez-img-overlay1:before, .dez-box .dez-img-overlay1:before {
            opacity: 0.5;
        }

        .dez-box .dez-info-has, .dez-media .dez-info-has {
            opacity: 1;
            width: 100%;
            margin-bottom: 0;
        }

        .dez-info-has {
            top: 80px;
        }
    </style>
    <!-- Content -->
    <div class="page-content">
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="{{ route('web.home') }}">Home</a></li>
                    <li>{{ !empty($category[0]->title) ? $category[0]->title : '' }}</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <!-- contact area -->
        <div class="content-inner section-full bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <div class="widget bg-white">
                            <h4 class="widget-title">Search</h4>
                            <div class="search-bx">
                                <form role="search" method="post">
                                    <div class="input-group">
                                        <input name="text" class="form-control" placeholder="Write your text"
                                               type="text">
                                        <span class="input-group-btn">
										<button type="submit" class="site-button"><i class="fa fa-search"></i></button>
										</span></div>
                                </form>
                            </div>
                        </div>
                        <div class="widget bg-white p-a20 widget_categories">
                            <h4 class="widget-title">Categories List</h4>
                            @if(!empty($ul_cats))
                                <ul>
                                    @foreach($ul_cats AS $cat)
                                        <?php
                                        $wheres = [
                                            'category_id' => $cat->id,
                                            'status' => '1'
                                        ];
                                        $product_count = $controller->selectFunction('products', array('id'), $wheres);
                                        ?>
                                        <li><a href="{{ route('web.category.products', ['id' => $cat->id, 'title' => str_slug($cat->title, '-')]) }}">{{ $cat->title }}</a> ({{ count($product_count) }})</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-8">
                        <div class="row" id="masonry">
                            @if(!empty($products))
                                @foreach($products AS $product)
                                    <?php
                                    $i_where = [
                                        'product_id' => $product->id
                                    ];
                                    $pimg = $controller->selectLimitFunction('product_images', array('filename'), $i_where, '1');
                                    $pimg = !empty($pimg[0]->filename) ? $pimg[0]->filename : '';
                                    ?>
                                    <div class="col-md-4 col-sm-4 m-b30 product-item card-container">
                                        <div class="dez-box ">
                                            <div class="dez-thum-bx  dez-img-effect min-height-class"><img
                                                        src="{{ asset('uploads/products').'/'.$pimg }}" alt="">
                                                <div class="overlay-bx">
                                                    <div class="overlay-icon">
                                                        <a href="javascript:void(0)" data-toggle="modal"
                                                           data-target="#myModal"> <i
                                                                    class="fa fa-cart-plus icon-bx-xs"></i> </a>
                                                        <a href="javascript:void(0)" data-toggle="modal"
                                                           data-target="#myModal"> <i
                                                                    class="fa fa-search icon-bx-xs"></i> </a>
                                                        <a href="javascript:void(0)" data-toggle="modal"
                                                           data-target="#myModal"> <i
                                                                    class="fa fa-heart icon-bx-xs"></i> </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dez-info p-a20 text-center">
                                                <h4 class="dez-title m-t0 text-uppercase"><a
                                                            href="#">{{ $product->title }}</a></h4>
                                                <h2 class="m-b0">{{--<del class="m-r10">$25.00</del> --}}
                                                    ${{ $product->price }} </h2>
                                                <div class="m-t20">
                                                    <a href="{{ route('web.products', ['id' => $product->id, 'title' => str_slug($product->title, '-')]) }}" class="site-button">View Details</a>
                                                </div>
                                            </div>
                                            {{--<div class="sale">
                                                <span class="site-button button-sm red">Sale</span>
                                            </div>--}}
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body" style="padding: 0">
                    <div class="dez-box">
                        <div class="dez-media dez-img-overlay1"><img src="{{ asset('site-assets/images/bg/bg6.jpg') }}"
                                                                     alt=""></div>
                        <div class="dez-info-has p-a20">
                            <div class="dez-coming-bx download-padding">
                                <div class="text-center">
                                    <a href="{{ route('web.home') }}">
                                        <img src="{{ asset('site-assets/images/logo-white.png') }}" alt=""/>
                                    </a>
                                </div>
                                <div class="coming-soon-content text-center text-white m-b30">
                                    <h2>Download our app now</h2>
                                </div>
                                <div class="countdown text-center">
                                    <a href="javascript:"
                                       class="site-button radius-xl outline  m-lr5 white text-uppercase">Download
                                        now</a>
                                </div>
                                <div class="text-center m-t50 info-style-1">
                                    <a href="{{ route('web.home') }}"
                                       class="site-button radius-xl outline  m-lr5 white">Go home</a>
                                    <a href="{{ route('web.for.suppliers') }}"
                                       class="site-button radius-xl m-lr5 openbtn">I am a Supplier</a>
                                    <a href="javascript:;" class="site-button radius-xl outline  m-lr5 white"
                                       data-dismiss="modal" aria-label="Close">Close</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop