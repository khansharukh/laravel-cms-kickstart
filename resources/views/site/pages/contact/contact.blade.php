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
@section('title', 'Contact us')
@section('content')
    <?php
    $wheres = [
        'status' => '1'
    ];
    $contacts = $controller->selectFunction('contacts', '*', $wheres);
    ?>

    <!-- Content -->
    <div class="page-content">
        <!-- inner page banner -->
        <div class="dez-bnr-inr overlay-black-middle" style="background-image:url({{ asset('site-assets/images/bnr1.jpg') }})">
            <div class="container">
                <div class="dez-bnr-inr-entry">
                    <h1 class="text-white">Contact Us</h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="{{ route('web.home') }}">Home</a></li>
                    <li>Contact us</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <!-- contact area -->
        <div class="section-full content-inner bg-white contact-style-1">
            <div class="container">
                <div class="row">
                    <!-- right part start -->
                    <div class="col-md-4">
                        <div class="p-a30 m-b30 border contact-area border-1">
                            <h2 class="m-b10">Quick Contact</h2>
                            <p>If you have any questions simply use the following contact details.</p>
                            <ul class="no-margin">
                                <li class="icon-bx-wraper left m-b30">
                                    <div class="icon-bx-xs border-1"> <a href="#" class="icon-cell"><i class="fa fa-map-marker"></i></a> </div>
                                    <div class="icon-content">
                                        <h6 class="text-uppercase m-tb0 dez-tilte">Address:</h6>
                                        <p>123 West Street, Melbourne Victoria 3000 Australia</p>
                                    </div>
                                </li>
                                <li class="icon-bx-wraper left  m-b30">
                                    <div class="icon-bx-xs border-1"> <a href="#" class="icon-cell"><i class="fa fa-envelope"></i></a> </div>
                                    <div class="icon-content">
                                        <h6 class="text-uppercase m-tb0 dez-tilte">Email:</h6>
                                        <p>info@company.com</p>
                                    </div>
                                </li>
                                <li class="icon-bx-wraper left">
                                    <div class="icon-bx-xs border-1"> <a href="#" class="icon-cell"><i class="fa fa-phone"></i></a> </div>
                                    <div class="icon-content">
                                        <h6 class="text-uppercase m-tb0 dez-tilte">PHONE</h6>
                                        <p>+61 3 8376 6284</p>
                                    </div>
                                </li>
                            </ul>
                            <div class="m-t20">
                                <ul class="dez-social-icon border dez-social-icon-lg">
                                    <li><a href="javascript:void(0);" class="fa fa-facebook bg-primary"></a></li>
                                    <li><a href="javascript:void(0);" class="fa fa-twitter bg-primary"></a></li>
                                    <li><a href="javascript:void(0);" class="fa fa-linkedin bg-primary"></a></li>
                                    <li><a href="javascript:void(0);" class="fa fa-pinterest-p bg-primary"></a></li>
                                    <li><a href="javascript:void(0);" class="fa fa-google-plus bg-primary"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- right part END -->
                    <!-- Left part start -->
                    <div class="col-md-4">
                        <div class="p-a30 bg-gray clearfix m-b30 ">
                            <h2>Send Message Us</h2>
                            <div class="dzFormMsg"></div>
                            <form method="post" class="dzForm" action="http://gardenzone.dexignlab.com/xhtml/script/contact.php">
                                <input type="hidden" value="Contact" name="dzToDo">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="dzName" type="text" required class="form-control" placeholder="Your Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input name="dzEmail" type="email" class="form-control" required placeholder="Your Email Id">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <textarea name="dzMessage" rows="4" class="form-control" required placeholder="Your Message..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button name="submit" type="submit" value="Submit" class="site-button "> <span>Submit</span> </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Left part END -->
                    <div class="col-md-4">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d227748.3825624477!2d75.65046970649679!3d26.88544791796718!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396c4adf4c57e281%3A0xce1c63a0cf22e09!2sJaipur%2C+Rajasthan!5e0!3m2!1sen!2sin!4v1500819483219" style="border:0; width:100%; height:455px;" allowfullscreen></iframe>
                    </div>

                </div>
            </div>
        </div>
        <!-- contact area  END -->
    </div>
@stop