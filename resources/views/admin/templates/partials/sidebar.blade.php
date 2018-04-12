<?php
/**
 * Created by PhpStorm.
 * User: Khan
 * Date: 9/10/2017
 * Time: 1:24 PM
 */
?>
@extends('admin.templates.partials.navigation')
@section('sidebar')
    @if(!empty(Session::get('admin_array')))
        <?php
        $logged_array = Session::get('admin_array');
        $name = $logged_array[0]->name;
        ?>
    <nav id="sidebar" class="nav-sidebar">
        <ul class="list-unstyled components slimescroll-id" id="accordion">
            <div class="user-profile">
                <div class="dropdown user-pro-body">
                    <div><img src="https://placehold.it/300x300" alt="user-img" class="img-circle"></div>
                    <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $name }} </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('admin.profile') }}"><i class="ti-user"></i> My Profile</a></li>
                        <li><a href="{{ route('admin.profile') }}"><i class="ti-wallet"></i> Edit Profile</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a href="{{ route('admin.settings') }}"><i class="ti-settings"></i> Account Setting</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a href="{{ route('admin.logout') }}"><i class="fa fa-power-off"></i> Logout</a></li>
                    </ul>
                </div>
            </div>

            <li class="active">
                <a href="#bannerSubmenu" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
                    <i class="ti-home m-r-10"></i> Banners
                </a>
                <ul class="collapse list-unstyled" id="bannerSubmenu" data-parent="#accordion">
                    <li><a href="{{ route('admin.banner') }}">View banner</a></li>
                    <li><a href="{{ route('admin.banner.add') }}">Add banner</a></li>
                </ul>
            </li>
            <li>
                <a href="#aboutSubmenu" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
                    <i class="ti-home m-r-10"></i> About
                </a>
                <ul class="collapse list-unstyled" id="aboutSubmenu" data-parent="#accordion">
                    <li><a href="{{ route('admin.about') }}">View about</a></li>
                    <li><a href="{{ route('admin.about.add') }}">Add about</a></li>
                </ul>
            </li>
            <li>
                <a href="#categorySubmenu" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
                    <i class="ti-home m-r-10"></i> Categories
                </a>
                <ul class="collapse list-unstyled" id="categorySubmenu" data-parent="#accordion">
                    <li><a href="{{ route('admin.category') }}">View categories</a></li>
                    <li><a href="{{ route('admin.category.add') }}">Add categories</a></li>
                </ul>
            </li>
            <li>
                <a href="#sub_categorySubmenu" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
                    <i class="ti-home m-r-10"></i> Sub-Categories
                </a>
                <ul class="collapse list-unstyled" id="sub_categorySubmenu" data-parent="#accordion">
                    <li><a href="{{ route('admin.sub_category') }}">View sub-categories</a></li>
                    <li><a href="{{ route('admin.sub_category.add') }}">Add sub-categories</a></li>
                </ul>
            </li>
            <li>
                <a href="#contactSubmenu" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
                    <i class="ti-home m-r-10"></i> Contacts
                </a>
                <ul class="collapse list-unstyled" id="contactSubmenu" data-parent="#accordion">
                    <li><a href="{{ route('admin.contact') }}">View contacts</a></li>
                    <li><a href="{{ route('admin.contact.add') }}">Add contact</a></li>
                </ul>
            </li>
            <li><a href="{{ route('admin.social') }}" class=" wave-effect">
                    <i class="ti-home m-r-10"></i> Social Media</a>
            </li>
            <li><a href="{{ route('admin.unit') }}" class=" wave-effect">
                    <i class="ti-home m-r-10"></i> Units</a>
            </li>
            <li><a href="{{ route('admin.grade') }}" class=" wave-effect">
                    <i class="ti-home m-r-10"></i> Grades</a>
            </li>
            <li><a href="{{ route('admin.package') }}" class=" wave-effect">
                    <i class="ti-home m-r-10"></i> Packaging</a>
            </li>
            <li>
                <a href="{{ route('admin.suppliers') }}" class=" wave-effect">
                    <i class="ti-home m-r-10"></i> Suppliers</a>
            </li>
            <li>
                <a href="#testimonialSubmenu" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
                    <i class="ti-home m-r-10"></i> Testimonials
                </a>
                <ul class="collapse list-unstyled" id="testimonialSubmenu" data-parent="#accordion">
                    <li><a href="{{ route('admin.testimonial') }}">View testimonials</a></li>
                    <li><a href="{{ route('admin.testimonial.add') }}">Add testimonials</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    @endif
@endsection
