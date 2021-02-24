@extends('frontend.layouts.master')
@section('body')
    {{-- <div id="wrapper">
        <div class="container welcome-container">
            <div class="image-center d-flex justify-content-center ">
                <img src="images/dulux_images/dulux_logo.png" alt="" srcset="" class="header-logo-image">
            </div>
            <h1 class="d-flex justify-content-center welcome-heading">Welcome</h1>
            <div class="row align-middle d-flex justify-content-center">
                <div class="col-sm-6 d-flex justify-content-center">
                    <button class="btn btn-lg btn-success btn-beginner"> I'm a Beginner</button>
                </div>
                <div class="col-sm-6 d-flex justify-content-center ">
                    <a href="{{ url('/color') }}" class="btn btn-lg btn-success btn-expert"> I'm an Expert</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-center">
                    <button class="btn btn-lg btn-primary btn-search">Search</button>
                </div>
            </div>
        </div>
    </div> --}}
    <keep-alive>
        <router-view />
    </keep-alive>
@endsection