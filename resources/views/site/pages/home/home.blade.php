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
@section('title', 'Home')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    <style>


        @media only screen and (min-width: 768px) {
            .main-slider {
                height: 350px;
                min-height: 350px;
                overflow: hidden;
            }
            .slick-slider {
                height: 350px;
            }
            .slick-slider img {
                position: relative;
                top: -200px;
            }
            .slick-slider-caption {
                display: block;
            }
        }
        .slick-slider-caption {
            display: none;
        }

        .slick-arrow {
            z-index: 1;
        }

        .slick-next {
            right: 0 !important;
        }

        .slick-prev {
            left: 0 !important;
        }

        .slick-dots {
            bottom: 10px;
        }

        .slick-dotted.slick-slider {
            margin-bottom: 0;
        }
        .section-full {
            margin-top: 50px;
        }
    </style>
    <?php
    $wheres = [
        'status' => '1'
    ];
    $banners = $controller->selectFunction('banners', array('id', 'cap_title', 'caption', 'link', 'target', 'filename'), $wheres);
    $abouts = $controller->selectFunction('about', array('id', 'title', 'description', 'file'), $wheres);
    $testimonials = $controller->selectFunction('testimonials', array('name', 'comment', 'image', 'created_at'), $wheres);
    ?>

    <!-- Content -->
    <div class="page-content">
        <!-- Slider -->
        <div class="main-slider style-two default-banner" id="home">
            <div class="tp-banner-container">
                <div class="tp-banner">
                    <div class="slick-slider">
                        @if(!empty($banners))
                            @foreach($banners AS $banner)
                                <div class="item">
                                    @if($banner->link)
                                        <a href="{{ $banner->link }}" target="{{ $banner->target }}">
                                            @endif
                                            <img src="{{ asset('uploads/banners').'/'.$banner->filename }}"
                                                 class="img-responsive">
                                            @if($banner->link)
                                        </a>
                                        <div class="slick-slider-caption">
                                            <div class="slick-caption-title">
                                                {{ $banner->cap_title }}
                                            </div>
                                            <div class="slick-caption-content">
                                                {{ $banner->caption }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider END -->
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
                                        {!! strlen($about->description) > 1500 ? substr(html_entity_decode($about->description), 0, 1500).'...' : $about->description !!}
                                    </p>
                                    @if(strlen($about->description) > 1500)
                                        <a href="{{ route('web.about.us') }}" class="site-button">Read More</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <!-- About Us END -->
        <div class="section-full bg-white content-inner dez-about-appoint">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="dez-thum disnone-sm"><img
                                    src="{{ asset('site-assets/images/bg/thum1.jpg') }}"
                                    alt=""></div>
                    </div>
                    <div class="col-md-7">
                        <h3 class="h3">Register as a <span class="text-primary"> Supplier Now</span></h3>
                        <p class="m-b10"><strong>Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                                1500s, when an unknown...</strong></p>
                        <p class="m-b30">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                            unknown printer.</p>
                        <div class="clearfix bg-white p-a30 about-appoint">
                            <div class="dzFormMsg"></div>
                            <form id="register-form" action=""
                                  method="post" class="dzForm">
                                <input type="hidden" value="Contact" name="dzToDo">
                                <div class="row">
                                    <div class="register-home-form">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input name="full_name" type="text" required class="form-control"
                                                           placeholder="Your Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input name="email_id" type="email" class="form-control" required
                                                           placeholder="Your Email Id">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input name="password" type="password" required
                                                           class="form-control" placeholder="Enter your password">
                                                </div>
                                            </div>
                                        </div>
                                        <input name="location" type="hidden">
                                        <input name="address" type="hidden">
                                        <div class="col-md-12">
                                            <button name="submit" type="submit" value="Submit"
                                                    class="site-button outline text-uppercase" id="regiseter-now-btn"><span>Register now</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-12 register-success-form" style="display: none;">
                                        <h3 class="h4">Application for was <span class="text-primary"> submitted.</span>
                                        </h3>
                                        <p>Your registration was successful, you will not be able to login until your
                                            account is approved by administrator</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonials -->
        <div class="section-full bg-img-fix overlay-primary-dark content-inner "
             style="background: #999999;">
            <div class="container">
                <div class="section-head text-center text-white">
                    <h3 class="h3 text-uppercase">Testimonials</h3>
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
                                                            alt="" style="width: 100px"></div>
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
@section('internal-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $('.slick-slider').slick({
            dots: true,
            infinite: true,
            speed: 500,
            fade: true,
            cssEase: 'linear',
            autoplay: true,
            autoplaySpeed: 2000
        });
    </script>
    <script>
        $('#register-form').on('submit', function (e) {
            e.preventDefault();
            $('#regiseter-now-btn').html('Registering...');
            $('#regiseter-now-btn').prop('disabled', true);

            var form = $('#register-form');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: form.attr('action'),
                data: form.serialize(),
                success: function (msg) {
                    if (msg === '1') {
                        $('.register-home-form').hide();
                        $('.register-success-form').fadeIn();
                    } else {
                        alert(msg);
                    }
                }
            });
        });
    </script>
@stop