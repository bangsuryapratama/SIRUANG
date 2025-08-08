@extends('layouts.frontend')

<!-- ======= Header =======-->
<header class="fbs__net-navbar navbar navbar-expand-lg dark" aria-label="freebootstrap.net navbar">
    <div class="container d-flex align-items-center justify-content-between">
        <!-- Start Logo-->
        <a class="navbar-brand w-auto" href="{{ url('/') }}">
            <!-- Logo dark-->
            <img class="logo dark img-fluid" src="{{ asset('assets/frontend/assets/images/logo-dark.svg') }}" alt="Logo dark">
            <!-- Logo light-->
            <img class="logo light img-fluid" src="{{ asset('assets/frontend/assets/images/logo-light.svg') }}" alt="Logo light">
        </a>
        <!-- End Logo-->

        <!-- Start offcanvas-->
        <div class="offcanvas offcanvas-start w-75" id="fbs__net-navbars" tabindex="-1" aria-labelledby="fbs__net-navbarsLabel">
            <div class="offcanvas-header">
                <div class="offcanvas-header-logo">
                    <a class="logo-link" id="fbs__net-navbarsLabel" href="{{ url('/') }}">
                        <img class="logo dark img-fluid" src="{{ asset('assets/frontend/assets/images/logo-dark.svg') }}" alt="Logo dark">
                        <img class="logo light img-fluid" src="{{ asset('assets/frontend/assets/images/logo-light.svg') }}" alt="Logo light">
                    </a>
                </div>
                <button class="btn-close btn-close-black" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body align-items-lg-center">
                <ul class="navbar-nav nav me-auto ps-lg-5 mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link scroll-link active" aria-current="page" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link scroll-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link scroll-link" href="#pricing">Pricing</a></li>
                    <li class="nav-item"><a class="nav-link scroll-link" href="#how-it-works">How It Works</a></li>
                    <li class="nav-item"><a class="nav-link scroll-link" href="#services">Services</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item scroll-link" href="#">Multipages</a></li>
                            <li><a class="dropdown-item scroll-link" href="#services">Services</a></li>
                            <li><a class="dropdown-item scroll-link" href="#pricing">Pricing</a></li>
                            <li class="dropdown dropstart">
                                <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropstart <i class="bi bi-chevron-right"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item scroll-link" href="#services">Services</a></li>
                                    <li><a class="dropdown-item scroll-link" href="#pricing">Pricing</a></li>
                                    <li class="dropdown dropstart">
                                        <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                            Dropstart <i class="bi bi-chevron-right"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item scroll-link" href="#services">Services</a></li>
                                            <li><a class="dropdown-item scroll-link" href="#pricing">Pricing</a></li>
                                            <li><a class="dropdown-item scroll-link" href="#">Something else here</a></li>
                                            <li class="dropdown dropend">
                                                <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Dropend <i class="bi bi-chevron-right"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item scroll-link" href="#services">Services</a></li>
                                                    <li><a class="dropdown-item scroll-link" href="#pricing">Pricing</a></li>
                                                    <li><a class="dropdown-item scroll-link" href="#">Something else here</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link scroll-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
        <!-- End offcanvas-->

        <!-- Start Dropdown User -->
       <!-- Start Dropdown User -->
        <div class="dropdown ms-3">
            <a class="btn  btn-light dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle me-2 "></i>
                {{ Auth::check() ? Auth::user()->name : 'Akun' }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                @if(Auth::check())
                    <li><a class="dropdown-item" href="#">Profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        @else
            <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
            <li><a class="dropdown-item" href="{{ route('register') }}">Daftar</a></li>
        @endif
    </ul>
</div>
<!-- End Dropdown User -->

</header>
<!-- End Header-->
