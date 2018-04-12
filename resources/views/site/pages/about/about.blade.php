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
@section('title', 'About us')
@section('content')
    <?php
    $wheres = [
        'status' => '1'
    ];
    $abouts = $controller->selectFunction('about', array('id', 'title', 'description', 'file'), $wheres);
    $testimonials = $controller->selectFunction('testimonials', array('name', 'comment', 'image', 'created_at'), $wheres);
    ?>

    <!-- Content -->
    <div class="page-content">
        <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-black-middle" style="background-image:url({{ asset('site-assets/images/bnr1.jpg') }})">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">About us</h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="{{ route('web.home') }}">Home</a></li>
                    <li>About us</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <!-- About Us -->
        <div class="section-full about-us bg-white content-inner dez-about">
            <div class="container">
                <div class="tab-content">
                    @if(!empty($abouts))
                        @foreach($abouts AS $about)
                            <div class="row m-b50">
                                <div class="col-md-5 about-img m-b30">
                                    <img src="{{ asset('uploads/about').'/'.$about->file }}"
                                         alt=""/>
                                </div>
                                <div class="col-md-7">
                                    <div class="m-b20">
                                        <h3 class="h3 ">{{ $about->title }}</h3>
                                        <div class="clear"></div>
                                    </div>
                                    <p class="m-b30">
                                        {!! html_entity_decode($about->description) !!}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <!-- About Us END -->
        <!-- Testimonials -->
        <div class="section-full bg-img-fix content-inner-1 overlay-black-dark"
             style="background: #999999;">
            <div class="container">
                <div class="section-head text-center text-white">
                    <h3 class="h3 text-uppercase">WHAT CUSTOMERS SAID</h3>
                </div>
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="testimonial-five testimonial-7">
                            @if($testimonials)
                                @foreach($testimonials AS $testimonial)
                                    <div class="item">
                                        <div class="testimonial-7">
                                            <div class="testimonial-text">
                                                <p class="p-b20">
                                                    {{ $testimonial->comment }}
                                                </p>
                                            </div>
                                            <div class="testimonial-detail clearfix info">
                                                <div class="testimonial-pic"><img
                                                            src="{{ asset('uploads/testimonials').'/'.$testimonial->image }}"
                                                            alt="" style="width: 100px;"></div>
                                                <p class=" m-b0 text-white">
                                                    <strong>{{ $testimonial->name }}</strong>
                                                    <span> - {{ date('l jS \of F y', strtotime($testimonial->created_at)) }}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content END-->
    </div>
@stop