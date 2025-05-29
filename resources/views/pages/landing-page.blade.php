@extends('layouts.main')
@section('title')
PT. Trisurya Solusindo Utama || Main Pages
@endsection
@section('content')
<!-- Header-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css" rel="stylesheet">

<header class="py-0 mt-5 mb-5" data-aos="fade-down">
    <div class="container px-5 pb-0">
        <div class="row gx-5 align-items-center">
            <div class="col-xxl-5">
                <!-- Header text content-->
                <div class="text-center text-xxl-start">
                    <div class="badge bg-gradient-primary-to-secondary text-white mb-4"><div class="text-uppercase">Design &middot; Development &middot; Marketing</div></div>
                    <h1 class="display-3 fw-bolder mb-1"><span class="text-gradient d-inline" style="font-size: 52px">PT. Trisurya Solusindo Utama</span></h1>
                    <div class="fs-5 fw-bold mb-2 text-muted" style="font-size:2px " >Weighing Solution and System Integration & Specialist Purpose Machine</div>
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xxl-start mb-3">
                        <form action="{{route('product')}}" method="GET" class="d-flex">
                            <input type="hidden" name="category" value="{{ request('category') }}">
                            <input type="search" placeholder="Search" name="search" aria-label="Search" class="form-control me-2">
                            <button class="btn btn-outline-dark" type="submit"><i class="mdi mdi-magnify"></i></button>
                        </form>
                    </div>
                    
                </div>
                <p>info@trisuryasolusindo.com</p>
            </div>
            <div class="col-xxl-7 text-center">
                <!-- Header profile picture-->
                <div class="d-flex justify-content-center mt-3 mt-xxl-0">
                    <div class="profile bg-gradient-primary-to-secondary">
                        <!-- TIP: For best results, use a photo with a transparent background like the demo example below-->
                        <!-- Watch a tutorial on how to do this on YouTube (link)-->
                        <style>
                            /* Slider container */
                            .slider {
                                position: relative;
                                width: 50%;
                                margin: auto;
                                margin-top: -4rem;
                                overflow: hidden;
                                display: flex;
                                justify-content: center;
                                align-items: center; /* Center images vertically */
                                height: 400px; /* Set a fixed height */
                            }
                    
                            /* Image styling */
                            .slider img {
                                width: 100%;
                                max-height: 100%; /* Ensure the images fit within the container */
                                object-fit: contain; /* Maintain aspect ratio and avoid stretching */
                                transition: opacity 1s ease-in-out; /* Smooth transition for image change */
                            }
                    
                            /* Controls styling */
                            .controls {
                                position: absolute;
                                top: 50%;
                                width: 100%;
                                display: flex;
                                justify-content: space-between;
                                transform: translateY(-50%);
                            }
                    
                            .prev, .next {
                                background-color: rgba(0, 0, 0, 0.5);
                                color: white;
                                border: none;
                                padding: 10px;
                                cursor: pointer;
                                font-size: 24px;
                                margin-top: 3rem;
                                opacity: 0.2;
                            }
                    
                            .prev:hover, .next:hover {
                                background-color: rgba(0, 0, 0, 0.8);
                            }
                    
                            /* Hide previous/next buttons when not needed */
                            .controls button {
                                display: block;
                            }
                        </style>
                    
                        <div class="slider" id="imageSlider">
                            <img class="mt-5" src="{{ asset('TSR1.png') }}" alt="Profile Image" id="sliderImage">
                            <div class="controls">
                                <button class="prev" id="prevBtn">&lt;</button>
                                <button class="next" id="nextBtn">&gt;</button>
                            </div>
                        </div>
                        
                        <script>
                            let currentIndex = 0;
                            const images = [
                                @foreach ($slides as $slider)
                                "{{ asset('storage/slider/'.$slider->image) }}", // Add more images to the array as needed
                                @endforeach
                            ];
                        
                            const sliderImage = document.getElementById('sliderImage');
                            const prevBtn = document.getElementById('prevBtn');
                            const nextBtn = document.getElementById('nextBtn');
                        
                            // Update the image displayed in the slider
                            function updateSlider() {
                                sliderImage.style.opacity = 0; // Fade out the current image
                                setTimeout(() => {
                                    sliderImage.src = images[currentIndex]; // Change image after fade-out
                                    sliderImage.style.opacity = 1; // Fade in the new image
                                }, 500); // Wait for fade-out duration before changing the image
                            }
                        
                            // Show the previous image
                            prevBtn.addEventListener('click', function() {
                                currentIndex = (currentIndex === 0) ? images.length - 1 : currentIndex - 1;
                                updateSlider();
                            });
                        
                            // Show the next image
                            nextBtn.addEventListener('click', function() {
                                currentIndex = (currentIndex === images.length - 1) ? 0 : currentIndex + 1;
                                updateSlider();
                            });
                        
                            // Automatic sliding every 3 seconds
                            setInterval(function() {
                                currentIndex = (currentIndex === images.length - 1) ? 0 : currentIndex + 1;
                                updateSlider();
                            }, 5000); // 3000ms = 3 seconds
                        </script>
                        <div class="dots-1">
                            <!-- SVG Dots-->
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 191.6 1215.4" style="enable-background: new 0 0 191.6 1215.4" xml:space="preserve">
                                <g transform="translate(0.000000,1280.000000) scale(0.100000,-0.100000)">
                                    <path d="M227.7,12788.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,12801.6,289.7,12808.6,227.7,12788.6z"></path>
                                    <path d="M1507.7,12788.6c-151-50-253-216-222-362c25-119,136-230,254-255c194-41,395,142,375,339c-11,105-90,213-190,262        C1663.7,12801.6,1569.7,12808.6,1507.7,12788.6z"></path>
                                    <path d="M227.7,11508.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,11521.6,289.7,11528.6,227.7,11508.6z"></path>
                                    <path d="M1507.7,11508.6c-151-50-253-216-222-362c25-119,136-230,254-255c194-41,395,142,375,339c-11,105-90,213-190,262        C1663.7,11521.6,1569.7,11528.6,1507.7,11508.6z"></path>
                                    <path d="M227.7,10228.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,10241.6,289.7,10248.6,227.7,10228.6z"></path>
                                    <path d="M1507.7,10228.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,10241.6,1569.7,10248.6,1507.7,10228.6z"></path>
                                    <path d="M227.7,8948.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,8961.6,289.7,8968.6,227.7,8948.6z"></path>
                                    <path d="M1507.7,8948.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,8961.6,1569.7,8968.6,1507.7,8948.6z"></path>
                                    <path d="M227.7,7668.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,7681.6,289.7,7688.6,227.7,7668.6z"></path>
                                    <path d="M1507.7,7668.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,7681.6,1569.7,7688.6,1507.7,7668.6z"></path>
                                    <path d="M227.7,6388.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,6401.6,289.7,6408.6,227.7,6388.6z"></path>
                                    <path d="M1507.7,6388.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,6401.6,1569.7,6408.6,1507.7,6388.6z"></path>
                                    <path d="M227.7,5108.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,5121.6,289.7,5128.6,227.7,5108.6z"></path>
                                    <path d="M1507.7,5108.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,5121.6,1569.7,5128.6,1507.7,5108.6z"></path>
                                    <path d="M227.7,3828.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,3841.6,289.7,3848.6,227.7,3828.6z"></path>
                                    <path d="M1507.7,3828.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,3841.6,1569.7,3848.6,1507.7,3828.6z"></path>
                                    <path d="M227.7,2548.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,2561.6,289.7,2568.6,227.7,2548.6z"></path>
                                    <path d="M1507.7,2548.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,2561.6,1569.7,2568.6,1507.7,2548.6z"></path>
                                    <path d="M227.7,1268.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,1281.6,289.7,1288.6,227.7,1268.6z"></path>
                                    <path d="M1507.7,1268.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,1281.6,1569.7,1288.6,1507.7,1268.6z"></path>
                                </g>
                            </svg>
                            <!-- END of SVG dots-->
                        </div>
                        <div class="dots-2">
                            <!-- SVG Dots-->
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 191.6 1215.4" style="enable-background: new 0 0 191.6 1215.4" xml:space="preserve">
                                <g transform="translate(0.000000,1280.000000) scale(0.100000,-0.100000)">
                                    <path d="M227.7,12788.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,12801.6,289.7,12808.6,227.7,12788.6z"></path>
                                    <path d="M1507.7,12788.6c-151-50-253-216-222-362c25-119,136-230,254-255c194-41,395,142,375,339c-11,105-90,213-190,262        C1663.7,12801.6,1569.7,12808.6,1507.7,12788.6z"></path>
                                    <path d="M227.7,11508.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,11521.6,289.7,11528.6,227.7,11508.6z"></path>
                                    <path d="M1507.7,11508.6c-151-50-253-216-222-362c25-119,136-230,254-255c194-41,395,142,375,339c-11,105-90,213-190,262        C1663.7,11521.6,1569.7,11528.6,1507.7,11508.6z"></path>
                                    <path d="M227.7,10228.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,10241.6,289.7,10248.6,227.7,10228.6z"></path>
                                    <path d="M1507.7,10228.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,10241.6,1569.7,10248.6,1507.7,10228.6z"></path>
                                    <path d="M227.7,8948.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,8961.6,289.7,8968.6,227.7,8948.6z"></path>
                                    <path d="M1507.7,8948.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,8961.6,1569.7,8968.6,1507.7,8948.6z"></path>
                                    <path d="M227.7,7668.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,7681.6,289.7,7688.6,227.7,7668.6z"></path>
                                    <path d="M1507.7,7668.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,7681.6,1569.7,7688.6,1507.7,7668.6z"></path>
                                    <path d="M227.7,6388.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,6401.6,289.7,6408.6,227.7,6388.6z"></path>
                                    <path d="M1507.7,6388.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,6401.6,1569.7,6408.6,1507.7,6388.6z"></path>
                                    <path d="M227.7,5108.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,5121.6,289.7,5128.6,227.7,5108.6z"></path>
                                    <path d="M1507.7,5108.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,5121.6,1569.7,5128.6,1507.7,5108.6z"></path>
                                    <path d="M227.7,3828.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,3841.6,289.7,3848.6,227.7,3828.6z"></path>
                                    <path d="M1507.7,3828.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,3841.6,1569.7,3848.6,1507.7,3828.6z"></path>
                                    <path d="M227.7,2548.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,2561.6,289.7,2568.6,227.7,2548.6z"></path>
                                    <path d="M1507.7,2548.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,2561.6,1569.7,2568.6,1507.7,2548.6z"></path>
                                    <path d="M227.7,1268.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,1281.6,289.7,1288.6,227.7,1268.6z"></path>
                                    <path d="M1507.7,1268.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,1281.6,1569.7,1288.6,1507.7,1268.6z"></path>
                                </g>
                            </svg>
                            <!-- END of SVG dots-->
                        </div>
                        <div class="dots-3">
                            <!-- SVG Dots-->
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 191.6 1215.4" style="enable-background: new 0 0 191.6 1215.4" xml:space="preserve">
                                <g transform="translate(0.000000,1280.000000) scale(0.100000,-0.100000)">
                                    <path d="M227.7,12788.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,12801.6,289.7,12808.6,227.7,12788.6z"></path>
                                    <path d="M1507.7,12788.6c-151-50-253-216-222-362c25-119,136-230,254-255c194-41,395,142,375,339c-11,105-90,213-190,262        C1663.7,12801.6,1569.7,12808.6,1507.7,12788.6z"></path>
                                    <path d="M227.7,11508.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,11521.6,289.7,11528.6,227.7,11508.6z"></path>
                                    <path d="M1507.7,11508.6c-151-50-253-216-222-362c25-119,136-230,254-255c194-41,395,142,375,339c-11,105-90,213-190,262        C1663.7,11521.6,1569.7,11528.6,1507.7,11508.6z"></path>
                                    <path d="M227.7,10228.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,10241.6,289.7,10248.6,227.7,10228.6z"></path>
                                    <path d="M1507.7,10228.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,10241.6,1569.7,10248.6,1507.7,10228.6z"></path>
                                    <path d="M227.7,8948.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,8961.6,289.7,8968.6,227.7,8948.6z"></path>
                                    <path d="M1507.7,8948.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,8961.6,1569.7,8968.6,1507.7,8948.6z"></path>
                                    <path d="M227.7,7668.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,7681.6,289.7,7688.6,227.7,7668.6z"></path>
                                    <path d="M1507.7,7668.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,7681.6,1569.7,7688.6,1507.7,7668.6z"></path>
                                    <path d="M227.7,6388.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,6401.6,289.7,6408.6,227.7,6388.6z"></path>
                                    <path d="M1507.7,6388.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,6401.6,1569.7,6408.6,1507.7,6388.6z"></path>
                                    <path d="M227.7,5108.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,5121.6,289.7,5128.6,227.7,5108.6z"></path>
                                    <path d="M1507.7,5108.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,5121.6,1569.7,5128.6,1507.7,5108.6z"></path>
                                    <path d="M227.7,3828.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,3841.6,289.7,3848.6,227.7,3828.6z"></path>
                                    <path d="M1507.7,3828.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,3841.6,1569.7,3848.6,1507.7,3828.6z"></path>
                                    <path d="M227.7,2548.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,2561.6,289.7,2568.6,227.7,2548.6z"></path>
                                    <path d="M1507.7,2548.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,2561.6,1569.7,2568.6,1507.7,2548.6z"></path>
                                    <path d="M227.7,1268.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,1281.6,289.7,1288.6,227.7,1268.6z"></path>
                                    <path d="M1507.7,1268.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,1281.6,1569.7,1288.6,1507.7,1268.6z"></path>
                                </g>
                            </svg>
                            <!-- END of SVG dots-->
                        </div>
                        <div class="dots-4">
                            <!-- SVG Dots-->
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 191.6 1215.4" style="enable-background: new 0 0 191.6 1215.4" xml:space="preserve">
                                <g transform="translate(0.000000,1280.000000) scale(0.100000,-0.100000)">
                                    <path d="M227.7,12788.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,12801.6,289.7,12808.6,227.7,12788.6z"></path>
                                    <path d="M1507.7,12788.6c-151-50-253-216-222-362c25-119,136-230,254-255c194-41,395,142,375,339c-11,105-90,213-190,262        C1663.7,12801.6,1569.7,12808.6,1507.7,12788.6z"></path>
                                    <path d="M227.7,11508.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,11521.6,289.7,11528.6,227.7,11508.6z"></path>
                                    <path d="M1507.7,11508.6c-151-50-253-216-222-362c25-119,136-230,254-255c194-41,395,142,375,339c-11,105-90,213-190,262        C1663.7,11521.6,1569.7,11528.6,1507.7,11508.6z"></path>
                                    <path d="M227.7,10228.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,10241.6,289.7,10248.6,227.7,10228.6z"></path>
                                    <path d="M1507.7,10228.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,10241.6,1569.7,10248.6,1507.7,10228.6z"></path>
                                    <path d="M227.7,8948.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,8961.6,289.7,8968.6,227.7,8948.6z"></path>
                                    <path d="M1507.7,8948.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,8961.6,1569.7,8968.6,1507.7,8948.6z"></path>
                                    <path d="M227.7,7668.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,7681.6,289.7,7688.6,227.7,7668.6z"></path>
                                    <path d="M1507.7,7668.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,7681.6,1569.7,7688.6,1507.7,7668.6z"></path>
                                    <path d="M227.7,6388.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,6401.6,289.7,6408.6,227.7,6388.6z"></path>
                                    <path d="M1507.7,6388.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,6401.6,1569.7,6408.6,1507.7,6388.6z"></path>
                                    <path d="M227.7,5108.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,5121.6,289.7,5128.6,227.7,5108.6z"></path>
                                    <path d="M1507.7,5108.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,5121.6,1569.7,5128.6,1507.7,5108.6z"></path>
                                    <path d="M227.7,3828.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,3841.6,289.7,3848.6,227.7,3828.6z"></path>
                                    <path d="M1507.7,3828.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,3841.6,1569.7,3848.6,1507.7,3828.6z"></path>
                                    <path d="M227.7,2548.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,2561.6,289.7,2568.6,227.7,2548.6z"></path>
                                    <path d="M1507.7,2548.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,2561.6,1569.7,2568.6,1507.7,2548.6z"></path>
                                    <path d="M227.7,1268.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C383.7,1281.6,289.7,1288.6,227.7,1268.6z"></path>
                                    <path d="M1507.7,1268.6c-105-35-200-141-222-248c-43-206,163-412,369-369c155,32,275,190,260,339c-11,105-90,213-190,262        C1663.7,1281.6,1569.7,1288.6,1507.7,1268.6z"></path>
                                </g>
                            </svg>
                            <!-- END of SVG dots-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- About Section-->
{{-- <section class="bg-light py-5" data-aos="fade-up">
    <div class="container px-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-xxl-8">
                <div class="text-center my-5">
                    <h2 class="display-5 fw-bolder"><span class="text-gradient d-inline">Rekomendasi Produk</span></h2>
                    <p class="lead fw-light mb-4">This Is Are The Product Recomendation On PT. Trisurya Solusi Indonesia</p>
                    <section class="py-5">
                        <div class=" px-4 px-lg-5">
                            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                                @foreach ($data as $d)
                                    <div class="col mb-5">
                                        <div class="card h-100 shadow-sm border-0">
                                            <!-- Product image carousel -->
                                            @if($d->gambar)
                                                @php
                                                    $images = json_decode($d->gambar);
                                                @endphp
                                                <div id="carousel{{ $d->id }}" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-inner">
                                                        @foreach ($images as $index => $image)
                                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                                <img src="{{ Storage::url($image) }}" class="d-block w-100 card-img-top" style="object-fit: cover; height: 250px;" alt="Product Image">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $d->id }}" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $d->id }}" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Next</span>
                                                    </button>
                                                </div>
                                            @endif
                                            <!-- Product details -->
                                            <div class="card-body text-center">
                                                <h5 class="card-title fw-bold mb-2">{{ $d->name }}</h5>
                                                <p class="text-muted mb-1">Rp. {{ number_format($d->harga, 0, ',', '.') }}</p>
                                                <p class="card-text">{{ \Illuminate\Support\Str::limit($d->deskripsi, 20, '...') }}</p>
                                            </div>
                                            <!-- Product actions -->
                                            <div class="card-footer bg-transparent border-top-0">
                                                <!-- Button to trigger the modal -->
                                                <a href="#" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#productModal-{{ $d->id }}">Lihat Produk</a>
                
                                                <!-- Fullscreen Modal -->
                                                <div class="modal fade" id="productModal-{{ $d->id }}" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-fullscreen">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="productModalLabel">Product Name : {{ $d->name }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Carousel for product images -->
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        @if($d->gambar)
                                                                            @php
                                                                                $images = json_decode($d->gambar); // Decode the JSON string into an array
                                                                            @endphp
                                                                            <div id="carousel{{ $d->id }}" class="carousel slide" data-bs-ride="carousel">
                                                                                <div class="carousel-inner">
                                                                                    @foreach ($images as $index => $image)
                                                                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                                                            <img src="{{ Storage::url($image) }}" class="d-block w-100" alt="Product Image">
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                                <!-- Carousel Controls -->
                                                                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $d->id }}" data-bs-slide="prev">
                                                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                                    <span class="visually-hidden">Previous</span>
                                                                                </button>
                                                                                <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $d->id }}" data-bs-slide="next">
                                                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                                    <span class="visually-hidden">Next</span>
                                                                                </button>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                            
                                                                    <!-- Product Information Section -->
                                                                    <div class="col-md-6">
                                                                        <div class="container">
                                                                            <div class="row">
                                                                                <!-- Product Description -->
                                                                                <div class="col-12 col-lg-8">
                                                                                    <div class="mt-4">
                                                                                        <h4 class="fw-bold text-dark">Description</h4>
                                                                                        <p class="text-muted">{{ $d->deskripsi }}</p>
                                                                                    </div>
                                                                                </div>
                                                            
                                                                                <!-- Price and Specifications Section -->
                                                                                <div class="col-12 col-lg-4">
                                                                                    <!-- Product Price -->
                                                                                    <div class="card border-0 shadow-sm mb-4">
                                                                                        <div class="card-body">
                                                                                            <h5 class="text-success fw-bold" style="font-size: 1.5rem;">${{ number_format($d->harga, 2) }}</h5>
                                                                                            <p class="text-muted">Price</p>
                                                                                        </div>
                                                                                    </div>
                                                            
                                                                                    <!-- Product Specifications -->
                                                                                    @if($d->sfesifikasi)
                                                                                        @php
                                                                                            $specifications = json_decode($d->sfesifikasi);
                                                                                        @endphp
                                                                                        <div class="card border-0 shadow-sm">
                                                                                            <div class="card-body">
                                                                                                <h5 class="fw-bold">Specifications</h5>
                                                                                                <ul class="list-group list-group-flush">
                                                                                                    @foreach ($specifications as $value)
                                                                                                    <li class="list-group-item">
                                                                                                        <strong><i class="fa-solid fa-check fw-bold" style="color: #007bff;"></i></strong> {{ $value }}
                                                                                                    </li>
                                                                                                    
                                                                                                    @endforeach
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-12 text-center">
                                                                                <a href="{{route('product.whatsapp',$d->id)}}" class="btn btn-success"><i class="fa-brands fa-whatsapp"></i> Pesan Sekarang</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<section class="container">
    <img src="{{ asset('section.png') }}" 
         class="responsive-img" 
         alt="" 
         data-aos="fade-up" 
         data-aos-duration="1000">
</section>

<style>
.container {
    max-width: 1200px; /* Adjust to your container's desired max width */
    margin: 0 auto; /* Center the section */
    padding: 20px; /* Optional padding for better spacing */
}

.responsive-img {
    width: 100%; /* Make the image responsive */
    height: auto; /* Maintain the aspect ratio */
    max-height: 720px; /* Set a maximum height */
    object-fit: cover; /* Ensure the image fits well */
    border-radius: 8px; /* Optional: Add rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional: Add a subtle shadow */
}
</style>



<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>
<script>
    AOS.init({
        duration: 1200, // Animation duration
    });
</script>
@endsection