<?php
/**
 * Created by PhpStorm.
 * User: Khan
 * Date: 9/10/2017
 * Time: 1:24 PM
 */
?>
@if(!empty(Session::get('admin_array')))
    <header class="main-navbar-header">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top theme-color top-inner-navbar">
            <div class="menu-toggle-button">
                <a class="nav-link wave-effect" href="#" id="sidebarCollapse">
                    <span class="ti-menu"></span>
                </a>
            </div>
            <a class="navbar-brand" href="#">Laravel CMS - Admin Panel</a>

            <ul class="navbar-nav ml-auto navbar-top-links">
                <li class="dropdown">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img
                                src="https://placehold.it/200x200" alt="user-img" width="36" class="img-circle">
                        <b class="d-none d-sm-inline-block">First name</b></a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <div class="dw-user-box">
                                <div class="u-img"><img src="https://placehold.it/200x200" alt="user"></div>
                                <div class="u-text">
                                    <h4>First Last name</h4>
                                    <p class="text-muted">user@mail.com</p><a href="profile.html"
                                                                              class="btn btn-rounded btn-danger btn-sm">View
                                        Profile</a></div>
                            </div>
                        </li>
                        <div class="dropdown-divider"></div>
                        <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                        <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                        <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a href="#"><i class="fa fa-power-off"></i> Logout</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
    </header>
@endif
@yield('sidebar')
