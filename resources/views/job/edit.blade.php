@extends('layouts.app')

@section('title', 'TQH Job Listing')

@section('content')
<!-- Hero Area Start-->
<div class="slider-area">
    <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="{{ asset($company->cover_image) }}">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2 class="custom-word-wrap">{{ $company->name }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero Area End -->
<form action="{{ route('job.store') }}" method="POST">
    @csrf
    <div class="d-flex flex-column justify-content-center align-items-center mt-50 mb-50">
        <div class="d-flex justify-content-center custom-90-width mb-4">
            <h3>New Job</h3>
        </div>
        <div class="card mb-4 custom-90-width">
            <div class="card-body">
                <div class="mt-10"></div>
                <input type="number" name="companyId" value="{{ $company->id }}" hidden>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Title</p>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="title" class="form-control">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Position</p>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="position" class="form-control">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Location</p>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="location" class="form-control">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Vacancy</p>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" name="vacancy" class="form-control">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Type</p>
                    </div>
                    <div class="col-sm-9">
                        <div class="d-flex align-items-center">
                            <input class="custom-radio-btn" type="radio" name="jobNature" value="0">
                            <p class="text-muted mb-0 d-inline-block ml-2">Full Time</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <input class="custom-radio-btn" type="radio" name="jobNature" value="1">
                            <p class="text-muted mb-0 d-inline-block ml-2">Part Time</p>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Salary</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">Min</p>
                        <input type="number" name="minSalary" class="form-control">
                        <div class="m-3"></div>
                        <p class="text-muted mb-0">Max</p>
                        <input type="number" name="maxSalary" class="form-control">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Expiration</p>
                    </div>
                    <div class="col-sm-9">
                        <input type="date" name="expirationDate" class="form-control">
                        <div class="m-3"></div>
                        <input type="time" name="expirationTime" class="form-control">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Description</p>
                    </div>
                    <div class="col-sm-9">
                        <textarea name="description" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="mb-10"></div>
            </div>
        </div>
        <div class="d-flex justify-content-end custom-90-width">
            <button class="btn head-btn1" type="submit">Post</button>
        </div>
    </div>
</form>
@endsection
