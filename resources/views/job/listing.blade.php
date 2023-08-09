@extends('layouts.app')

@section('title', 'TQH Job Listing')

@section('content')
<main>
    <div class="about-edit-btn d-flex">
        @if (!empty($company) && auth()->guard('company')->id() == $company->id)
            <a class="btn head-btn1" href="{{ route('job.edit') }}">New Job</a>
        @endif
    </div>
    <!-- Hero Area Start-->
    <div class="slider-area">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center" 
            data-background="{{ empty($company) ? asset('img/company_cover/about.jpg') : asset($company->cover_image) }}">            
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            @if (!empty($company) && auth()->guard('company')->id() == $company->id)
                                <h2>Posted Jobs</h2>
                            @else
                                @if (!empty($user) && auth()->guard('user')->id() == $user->id)
                                    <h2>Applied Jobs</h2>
                                @else
                                    <h2>Available Jobs</h2>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End -->
    <!-- Job List Area Start -->
    <div class="job-listing-area pt-120 pb-120">
        <div class="container">
            <div class="row">
                <!-- Left content -->
                <div class="col-xl-3 col-lg-3 col-md-4">
                    <div class="row">
                        <div class="col-12">
                                <div class="small-section-tittle2 mb-45">
                                <div class="ion"> <svg 
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="20px" height="12px">
                                <path fill-rule="evenodd"  fill="rgb(27, 207, 107)"
                                    d="M7.778,12.000 L12.222,12.000 L12.222,10.000 L7.778,10.000 L7.778,12.000 ZM-0.000,-0.000 L-0.000,2.000 L20.000,2.000 L20.000,-0.000 L-0.000,-0.000 ZM3.333,7.000 L16.667,7.000 L16.667,5.000 L3.333,5.000 L3.333,7.000 Z"/>
                                </svg>
                                </div>
                                <h4>Filter Jobs</h4>
                            </div>
                        </div>
                    </div>
                    <!-- Job Category Listing start -->
                    <form action="{{ route('job.filter') }}" method="GET">
                        @csrf

                        @if (!empty($company))
                            <input type="number" name="companyId" value="{{ $company->id }}" hidden>
                        @else
                            @if (!empty($request->companyId))
                                <input type="number" name="companyId" value="{{ $request->companyId }}" hidden>
                            @endif
                        @endif

                        @if (!empty($user))
                            <input type="number" name="userId" value="{{ $user->id }}" hidden>
                        @else
                            @if (!empty($request->userId))
                                <input type="number" name="userId" value="{{ $request->userId }}" hidden>
                            @endif
                        @endif

                        <div class="job-category-listing mb-50">
                            <!-- single one -->
                            <div class="single-listing">
                                <div class="small-section-tittle2">
                                    <h4>Search Box</h4>
                                </div>
                                <!-- Select job items start -->
                                <div class="select-job-items2">
                                    <input class="custom-grey-border p-2" type="text" name="searchText" 
                                        value="{{ empty($request->searchText) ? '' : $request->searchText }}">
                                </div>
                                <!--  Select job items End-->
                                <!-- select-Categories start -->
                                <div class="select-Categories pt-50 pb-50">
                                    <div class="small-section-tittle2">
                                        <h4>Job Type</h4>
                                    </div>
                                    @if (empty($request->jobNatures))
                                        <label class="container">Full Time
                                            <input type="checkbox" name="jobNatures[]" value="0">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="container">Part Time
                                            <input type="checkbox" name="jobNatures[]" value="1">
                                            <span class="checkmark"></span>
                                        </label>
                                    @else
                                        <label class="container">Full Time
                                            <input type="checkbox" name="jobNatures[]" value="0"
                                                {{ in_array(0, $request->jobNatures) ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="container">Part Time
                                            <input type="checkbox" name="jobNatures[]" value="1"
                                                {{ in_array(1, $request->jobNatures) ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                        </label>
                                    @endif
                                </div>
                                <!-- select-Categories End -->
                            </div>
                            <!-- single two -->
                            <div class="single-listing pb-90">
                                <div class="small-section-tittle2">
                                    <h4>Posted Within</h4>
                                </div>
                                <!-- Select job items start -->
                                <div class="select-job-items2">
                                    <select name="createdWithin">
                                        @if (empty($request))
                                            <option value="-1">Any</option>
                                            <option value="0">1 Day</option>
                                            <option value="1">1 Week</option>
                                            <option value="2">2 Weeks</option>
                                            <option value="3">1 Month</option>
                                        @else
                                            <option value="-1" {{ $request->createdWithin == -1 ? 'selected' : '' }}>Any</option>
                                            <option value="0" {{ $request->createdWithin == 0 ? 'selected' : '' }}>1 Day</option>
                                            <option value="1" {{ $request->createdWithin == 1 ? 'selected' : '' }}>1 Week</option>
                                            <option value="2" {{ $request->createdWithin == 2 ? 'selected' : '' }}>2 Weeks</option>
                                            <option value="3" {{ $request->createdWithin == 3 ? 'selected' : '' }}>1 Month</option>
                                        @endif
                                    </select>
                                </div>
                                <!--  Select job items End-->
                            </div>
                            <div class="single-listing pb-90">
                                <div class="small-section-tittle2">
                                    <h4>Salary</h4>
                                </div>
                                <!-- Select job items start -->
                                <div class="select-job-items2">
                                    <select name="salary">
                                        @if (empty($request))
                                            <option value="-1">Any</option>
                                            <option value="0">< 5.000.000đ</option>
                                            <option value="1">5.000.000đ - 10.000.000đ</option>
                                            <option value="2">10.000.000đ - 20.000.000đ</option>
                                            <option value="3">20.000.000đ - 30.000.000đ</option>
                                            <option value="4">> 30.000.000đ</option>
                                        @else
                                            <option value="-1" {{ $request->salary == -1 ? 'selected' : '' }}>Any</option>
                                            <option value="0" {{ $request->salary == 0 ? 'selected' : '' }}>< 5.000.000đ</option>
                                            <option value="1" {{ $request->salary == 1 ? 'selected' : '' }}>5.000.000đ - 10.000.000đ</option>
                                            <option value="2" {{ $request->salary == 2 ? 'selected' : '' }}>10.000.000đ - 20.000.000đ</option>
                                            <option value="3" {{ $request->salary == 3 ? 'selected' : '' }}>20.000.000đ - 30.000.000đ</option>
                                            <option value="4" {{ $request->salary == 4 ? 'selected' : '' }}>> 30.000.000đ</option>
                                        @endif
                                    </select>
                                </div>
                                <!--  Select job items End-->
                            </div>
                            <button class="btn apply-btn2" type="submit">Search</button>
                        </div>
                    </form>
                    <!-- Job Category Listing End -->
                </div>
                <!-- Right content -->
                <div class="col-xl-9 col-lg-9 col-md-8">
                    <!-- Featured_job_start -->
                    <section class="featured-job-area">
                        <div class="container">
                            <!-- Count of Job list Start -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="count-job mb-35">
                                        <span>{{ $count }} jobs found</span>
                                        <!-- Select job items start -->
                                        <div class="select-job-items">
                                            <span>Sort by</span>
                                            <select name="select">
                                                <option value="">None</option>
                                                <option value="">job list</option>
                                                <option value="">job list</option>
                                                <option value="">job list</option>
                                            </select>
                                        </div>
                                        <!--  Select job items End-->
                                    </div>
                                </div>
                            </div>
                            <!-- Count of Job list End -->
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
                    </section>
                    <!-- Featured_job_end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Job List Area End -->
    <!--Pagination Start  -->
    <div class="pagination-area pb-115 text-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="single-wrap d-flex justify-content-center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                {{ $jobs->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Pagination End  -->
</main>
@endsection
