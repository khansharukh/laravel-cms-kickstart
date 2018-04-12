<?php
/**
 * Created by PhpStorm.
 * User: Khan
 * Date: 9/10/2017
 * Time: 1:24 PM
 */

$wheres = [
    'id' => '1'
];
$social = $controller->selectFunction('socials', '*', $wheres);
$wheres = [
    'status' => '1'
];
$contacts = $controller->selectFunction('contacts', '*', $wheres);
?>
<!-- header -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('web.home') }}" class="nav-link">Home</a></li>
            <li class="nav-item {{ Request::is('about-us*') ? 'active' : '' }}"><a href="{{ route('web.about.us') }}" class="nav-link">About</a></li>
            <li class="nav-item {{ Request::is('contact-us*') ? 'active' : '' }}"><a href="{{ route('web.contact.us') }}" class="nav-link">Contact</a></li>
            <li class="nav-item {{ Request::is('categories*') ? 'active' : '' }}"><a href="{{ route('web.categories') }}" class="nav-link">Products</a></li>
        </ul>
    </div>
</nav>
<!-- header END -->