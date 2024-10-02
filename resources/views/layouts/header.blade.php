<!doctype html>
<html class="no-js" data-theme="light" lang="en-US">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        @if (Request::is('/'))
            Braindumps 4 Certification - Your Trusted Source for Exam Dumps
        @else
            {{ $post->post_title ?? 'Page Title' }}
        @endif
    </title>
    <meta name="author" content="Hussnain">
    <meta name="description" content="">
    <meta name="robots" content="follow, index">
    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons -->
    <link rel="manifest" href="{{ url('assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ url('assets/img/favicons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;400;500;600;700;800;900&family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">

</head>

<body>
    <div class="header-top" style="margin-bottom: -20px">
        <div class="th-menu-wrapper d-lg-none ">
            <div class="th-menu-area text-center">
                <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
                <div class="mobile-logo">
                    <a href="/"> <span style="font-size: 30px">
                            Brain Dumps 4 Certification</span></a>
                </div>
                <div class="th-mobile-menu">
                    <ul>
                        <li class="menu-item-has-children">
                            <a href="/">Home</a>
                        </li>
                        <li><a href="/about-us">About Us</a></li>
                        <li class="menu-item-has-children">
                            <a href="#">Category</a>
                            <ul class="sub-menu">
                                @foreach ($categories as $category)
                                    <li><a href="{{ url('/category/' . $category->slug) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">Pages</a>
                            <ul class="sub-menu">
                                @foreach ($pages->skip(0)->take(25) as $page)
                                    <li><a href="{{ url($page->post_name) }}">{{ $page->post_title }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <a href="/contact-us">Contact</a>
                        </li>
                        {{-- <li>
                            <a class="theme-toggler" href="#">
                                <span class="dark"><i class="fas fa-moon"></i>Dark Mode</span>
                                <span class="light"><i class="fas fa-sun-bright"></i>Light Mode</span>
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div><!--==============================
 Header Area
==============================-->
        <header class="th-header header-layout1">
            <div class="container">
                <div class="d-none d-lg-inline-block -pt-10">
                    <div class="py-3">
                        <div>
                            <a href="/">
                                <span style="font-size: 25px">
                                   <b> Brain Dumps 4 Certification</b></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sticky-wrapper">
                <!-- Main Menu Area -->
                <div class="menu-area">
                    <div class="container">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto d-lg-none d-block">
                                <div class="header-logo">
                                    <a href="/">
                                        <span style="font-size: 18px; color: white">
                                            Brain Dumps 4 Certification</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-auto">
                                <nav class="main-menu d-none d-lg-inline-block">
                                    <ul>
                                        <li>
                                            <a href="/">Home</a>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="#">Category</a>
                                            <ul class="sub-menu">
                                                @foreach ($categories as $category)
                                                    <li><a
                                                            href="{{ url('/category/' . $category->slug) }}">{{ $category->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="#">Pages</a>
                                            <ul class="sub-menu">
                                                @foreach ($pages->skip(0)->take(25) as $page)
                                                    <li><a
                                                            href="{{ url($page->post_name) }}">{{ $page->post_title }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li><a href="/about-us">About Us</a></li>
                                        <li>
                                            <a href="/contact-us">Contact</a>
                                        </li>
                                        {{-- <li>
                                            <a class="theme-toggler" href="#">
                                                <span class="dark"><i class="fas fa-moon"></i>Dark Mode</span>
                                                <span class="light"><i class="fas fa-sun-bright"></i>Light
                                                    Mode</span>
                                            </a>
                                        </li> --}}
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-auto">
                                <div class="header-button">
                                    <a href="#" class="icon-btn sideMenuToggler d-none d-lg-block"><i
                                            class="far fa-bars"></i></a>
                                    <button type="button" class="th-menu-toggle d-block d-lg-none"><i
                                            class="far fa-bars"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
