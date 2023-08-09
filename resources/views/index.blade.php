@extends('layouts.app')

@section('title', 'TQH Job Listing')

@section('content')
<main>
    <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="slider-active">
            <div class="single-slider slider-height d-flex align-items-center" data-background="{{ asset('img/hero/h1_hero.jpg') }}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-9 col-md-10">
                            <div class="hero__caption">
                                <h1>Find the most exciting startup jobs</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Search Box -->
                    <div class="row">
                        <div class="col-xl-8">
                            <!-- form -->
                            <form action="{{ route('job.filter') }}" class="search-box">
                                @csrf
                                <div class="input-form flex-grow-1">
                                    <input type="text" name="searchText" placeholder="Job Tittle or Keyword">
                                </div>
                                <div class="search-form">
                                    <button type="submit">Find Job</button>
                                </div>	
                            </form>	
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->
    <!-- Our Services Start -->
    <div class="our-services section-pad-t30">
        <div class="container">
            <!-- Section Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle text-center">
                        <span>FEATURED TOURS Packages</span>
                        <h2>Browse Top Categories </h2>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-contnet-center">
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="single-services text-center mb-30">
                        <div class="services-ion">
                            <span class="flaticon-tour"></span>
                        </div>
                        <div class="services-cap">
                        <h5><a href="#">Design & Creative</a></h5>
                            <span>(653)</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="single-services text-center mb-30">
                        <div class="services-ion">
                            <span class="flaticon-cms"></span>
                        </div>
                        <div class="services-cap">
                        <h5><a href="#">Design & Development</a></h5>
                            <span>(658)</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="single-services text-center mb-30">
                        <div class="services-ion">
                            <span class="flaticon-report"></span>
                        </div>
                        <div class="services-cap">
                        <h5><a href="#">Sales & Marketing</a></h5>
                            <span>(658)</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="single-services text-center mb-30">
                        <div class="services-ion">
                            <span class="flaticon-app"></span>
                        </div>
                        <div class="services-cap">
                        <h5><a href="#">Mobile Application</a></h5>
                            <span>(658)</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="single-services text-center mb-30">
                        <div class="services-ion">
                            <span class="flaticon-helmet"></span>
                        </div>
                        <div class="services-cap">
                        <h5><a href="#">Construction</a></h5>
                            <span>(658)</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="single-services text-center mb-30">
                        <div class="services-ion">
                            <span class="flaticon-high-tech"></span>
                        </div>
                        <div class="services-cap">
                        <h5><a href="#">Information Technology</a></h5>
                            <span>(658)</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="single-services text-center mb-30">
                        <div class="services-ion">
                            <span class="flaticon-real-estate"></span>
                        </div>
                        <div class="services-cap">
                        <h5><a href="#">Real Estate</a></h5>
                            <span>(658)</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="single-services text-center mb-30">
                        <div class="services-ion">
                            <span class="flaticon-content"></span>
                        </div>
                        <div class="services-cap">
                        <h5><a href="#">Content Writer</a></h5>
                            <span>(658)</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- More Btn -->
            <!-- Section Button -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="browse-btn2 text-center mt-50">
                        <a href="#" class="border-btn2">Browse All Sectors</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Services End -->
    <!-- Online CV Area Start -->
    @if (!auth()->guard('company')->check())
        <div class="online-cv cv-bg section-overly pt-90 pb-120"  data-background="{{ asset('img/gallery/cv_bg.jpg') }}">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="cv-caption text-center">
                            <p class="pera1">FEATURED TOURS Packages</p>
                            <p class="pera2"> Make a Difference with Your Online Resume!</p>
                            @if (auth()->guard('user')->check())
                                <a href="{{ route('user.show', [
                                    'id' => auth()->guard('user')->id()
                                ]) }}" class="border-btn2 border-btn4">Upload your cv</a>
                            @else
                                <a href="#" class="border-btn2 border-btn4" data-toggle="modal" data-target="#loginModal">Upload your cv</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <hr class="custom-blue-border m-auto" width="90%">
    @endif
    <!-- Online CV Area End-->
    <!-- Featured_job_start -->
    <section class="featured-job-area feature-padding">
        <div class="container">
            <!-- Section Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle text-center">
                        <span>Recent Job</span>
                        <h2>Featured Jobs</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <!-- single-job-content -->
                    @foreach ($jobs as $job)
                        @php
                            $imageIndex = rand(1, 4);
                        @endphp
                        <div class="single-job-items custom-job-items mb-30" data-id="{{ $job->id }}">
                            <div class="row job-items flex-grow-1">
                                <div class="col-lg-2 company-img">
                                    <img src="{{ asset("img/icon/job-list$imageIndex.png") }}" alt="">
                                </div>
                                <div class="col-lg-10 job-tittle job-tittle2">
                                    <div class="row justify-content-between flex-nowrap items-link items-link2">
                                        <h4 class="custom-word-wrap custom-75-width">{{ $job->title }}</h4>
                                        <a class="custom-no-hover">
                                            @if ($job->job_nature == 0)
                                                <span>Full time</span>
                                            @endif
                                            @if ($job->job_nature == 1)
                                                <span>Part time</span>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="row justify-content-between flex-nowrap mb-1">
                                        <li class="custom-word-wrap mr-2"><i class="fa fa-building mr-1" aria-hidden="true"></i>{{ $job->company->name }}</li>
                                        <li class="custom-word-wrap"><i class="fa fa-dollar-sign mr-1"></i>{{ $job->min_salary }}đ - {{ $job->max_salary }}đ</li>
                                    </div>
                                    <div class="row mb-3">
                                        <li class="custom-word-wrap mr-2"><i class="fas fa-map-marker-alt mr-1"></i>{{ $job->location }}</li>
                                    </div>
                                    <div class="row items-link items-link2 justify-content-between">
                                        <span>Posted at: {{ $job->created_at->format('Y-m-d') }}</span>
                                        <span>Expires after: {{ $job->created_at->diff($job->expires_at)->format('%a') }} days</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Featured_job_end -->
    <!-- How  Apply Process Start-->
    <div class="apply-process-area apply-bg pt-150 pb-150" data-background="{{ asset('img/gallery/how-applybg.png') }}">
        <div class="container">
            <!-- Section Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle white-text text-center">
                        <span>Apply process</span>
                        <h2> How it works</h2>
                    </div>
                </div>
            </div>
            <!-- Apply Process Caption -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-process text-center mb-30">
                        <div class="process-ion">
                            <span class="flaticon-search"></span>
                        </div>
                        <div class="process-cap">
                        <h5>1. Search a job</h5>
                        <p>Sorem spsum dolor sit amsectetur adipisclit, seddo eiusmod tempor incididunt ut laborea.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-process text-center mb-30">
                        <div class="process-ion">
                            <span class="flaticon-curriculum-vitae"></span>
                        </div>
                        <div class="process-cap">
                        <h5>2. Apply for job</h5>
                        <p>Sorem spsum dolor sit amsectetur adipisclit, seddo eiusmod tempor incididunt ut laborea.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-process text-center mb-30">
                        <div class="process-ion">
                            <span class="flaticon-tour"></span>
                        </div>
                        <div class="process-cap">
                        <h5>3. Get your job</h5>
                        <p>Sorem spsum dolor sit amsectetur adipisclit, seddo eiusmod tempor incididunt ut laborea.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- How  Apply Process End-->
    <!-- Support Company Start-->
    @if (!auth()->guard('user')->check())
        <div class="support-company-area support-padding fix pt-150 pb-150">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6">
                        <div class="right-caption">
                            <!-- Section Tittle -->
                            <div class="section-tittle section-tittle2">
                                <span>What we are doing</span>
                                <h2>24k Talented people are getting Jobs</h2>
                            </div>
                            <div class="support-caption">
                                <p class="pera-top">Mollit anim laborum duis au dolor in voluptate velit ess cillum dolore eu lore dsu quality mollit anim laborumuis au dolor in voluptate velit cillum.</p>
                                <p>Mollit anim laborum.Duis aute irufg dhjkolohr in re voluptate velit esscillumlore eu quife nrulla parihatur. Excghcepteur signjnt occa cupidatat non inulpadeserunt mollit aboru. temnthp incididbnt ut labore mollit anim laborum suis aute.</p>
                                @if (auth()->guard('company')->check())
                                    <a href="{{ route('job.edit') }}" class="btn post-btn">Post a job</a>
                                @else
                                    <a href="#" class="btn post-btn" data-toggle="modal" data-target="#loginModal">Post a job</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="support-location-img">
                            <img src="{{ asset('img/service/support-img.jpg') }}" alt="">
                            <div class="support-img-cap text-center">
                                <p>Since</p>
                                <span>1994</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Support Company End-->
</main>
@endsection
