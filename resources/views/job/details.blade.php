@extends('layouts.app')

@section('title', 'TQH Job Listing')

@section('content')
<main>
    <!-- Hero Area Start-->
    <div class="slider-area ">
    <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="{{ asset('img/hero/about.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>{{ $title }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Hero Area End -->
    <!-- job post company Start -->
    <div class="job-post-company pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-between">
                <!-- Left Content -->
                <div class="col-xl-7 col-lg-8">
                    <!-- job single -->
                    <div class="single-job-items mb-50 custom-no-hover custom-grey-border">
                        <div class="row job-items flex-grow-1">
                            <div class="col-lg-2 company-img company-img-details">
                                <img src="{{ asset('img/icon/job-list1.png') }}" alt="">
                            </div>
                            <div class="col-lg-10 job-tittle">
                                <h4 class="custom-word-wrap">{{ $title }}</h4>
                                <ul class="d-flex">
                                    <li class="custom-word-wrap"><i class="fas fa-map-marker-alt"></i>{{ $location }}</li>
                                </ul>
                                <ul class="d-flex">
                                    <li class="custom-word-wrap"><i class="fa fa-dollar-sign"></i>{{ $min_salary }}đ - {{ $max_salary }}đ</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                        <!-- job single End -->
                    <div class="job-post-details">
                        <div class="post-details1 mb-50">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Job Description</h4>
                            </div>
                            <p>{!! nl2br($description) !!}</p>
                        </div>
                    </div>
                </div>
                <!-- Right Content -->
                <div class="col-xl-4 col-lg-4">
                    <div class="post-details3 mb-50">
                        <!-- Small Section Tittle -->
                        <div class="small-section-tittle">
                            <h4>Job Overview</h4>
                        </div>
                        <ul>
                            <li>Posted date : <span>{{ $created_at->format('d M Y') }}</span></li>
                            <li>Location : <span class="custom-word-wrap text-right custom-75-width">{{ $location }}</span></li>
                            <li>Position : <span class="custom-word-wrap text-right custom-75-width">{{ $position }}</span></li>
                            <li>Vacancy : <span>{{ $vacancy }}</span></li>
                            <li>Applied : <span>{{ $applied }}</span></li>
                            <li>Job nature : 
                                @if ($job_nature == 0)
                                    <span>Full time</span>
                                @endif
                                @if ($job_nature == 1)
                                    <span>Part time</span>
                                @endif
                            </li>
                            <li>Salary : <span>{{ $min_salary }}đ - {{ $max_salary }}đ</span></li>
                            <li>Expiration date : <span>{{ $expires_at }}</span></li>
                        </ul>
                        <div class="d-flex justify-content-between">
                        @if (auth()->guard('company')->id() == $company->id)
                            <a href="#" class="btn apply-btn2">Edit Job</a>
                        @else
                            @if ($isUser)
                                @if ($canApply)
                                    <a href="{{ route('user.apply', ['jobId' => $id]) }}" class="btn apply-btn2 p-4">Apply Now</a>
                                @else
                                    <div class="btn p-4 custom-no-hover custom-green-background">Applied</div>
                                @endif
                            @else
                                <div class="btn p-4 custom-no-hover custom-grey-background">Apply Now</div>
                            @endif
                            <a href="{{ route('company.show', ['id' => $company->id]) }}" class="btn head-btn2 p-4">Company Page</a>
                        @endif
                        </div>
                    </div>
                    <div class="post-details4 mb-50">
                        <!-- Small Section Tittle -->
                        <div class="small-section-tittle">
                            <h4>Company Information</h4>
                        </div>
                            <span>{{ $company->name }}</span>
                            <p>
                                {!! nl2br(substr($company->description, 0, 135)) !!}
                                @if (strlen($company->description) > 135)
                                    ...
                                @endif
                            </p>
                        <ul>
                            <li class="d-flex justify-content-between">Address: <span class="custom-word-wrap text-right custom-75-width">{{ $company->address }}</span></li>
                            <li class="d-flex justify-content-between">Website: <span class="custom-word-wrap text-right custom-75-width">{{ $company->website }}</span></li>
                            <li class="d-flex justify-content-between">Phone: <span class="custom-word-wrap text-right custom-75-width">{{ $company->phone }}</span></li>
                            <li class="d-flex justify-content-between">Email: <span class="custom-word-wrap text-right custom-75-width">{{ $company->email }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            @if (auth()->guard('company')->check() && auth()->guard('company')->id() == $company->id)
                <hr class="custom-blue-border">
                <div class="row flex-column align-items-center">
                    <h4 class="mb-4">Candidates ({{ count($candidates) }})</h4>
                    @foreach ($candidates as $candidate)
                        <div class="single-job-items custom-candidate-items mb-40
                            custom-grey-border custom-90-width custom-blue-border-hover" data-id="{{ $candidate->id }}">
                            <div class="row job-items flex-grow-1">
                                <div class="col-lg-2 d-flex justify-content-center company-img company-img-details">
                                    <img class="mr-0" src="{{ asset('img/icon/job-list1.png') }}" alt="">
                                </div>
                                <div class="col-lg-10 job-tittle">
                                    <h4 class="custom-word-wrap">{{ $candidate->name }}</h4>
                                    <ul class="d-flex">
                                        <li class="custom-word-wrap">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i>{{ now()->diff($candidate->dob)->y }},
                                            @switch($candidate->gender)
                                                @case(0)
                                                    Male
                                                    @break
                                                @case(1)
                                                    Female
                                                    @break
                                            @endswitch
                                        </li>
                                    </ul>
                                    <ul class="d-flex">
                                        <li class="custom-word-wrap"><i class="fa fa-envelope" aria-hidden="true"></i>{{ $candidate->email }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <!-- job post company End -->
</main>
@endsection
