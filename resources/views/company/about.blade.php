@extends('layouts.app')

@section('title', 'TQH Job Listing')

@section('content')
<main>
    <form method="POST" action="{{ route('company.store') }}">
        @csrf

        <div class="about-edit-btn d-flex">
        @if (auth()->guard('company')->id() == $id)
            @if ($isEditing)
                <a class="btn head-btn2 mr-3 label-color-white" href="{{ route('company.show', ['id' => $id]) }}">Back</a>
                <button class="btn head-btn1" type="submit">Save</button>
            @else
                <a class="btn head-btn1" href="{{ route('company.edit') }}">Edit</a>
            @endif
        @else
            <a class="btn head-btn1" href="{{ route('company.jobs', ['id' => $id]) }}">View Jobs</a>
        @endif
        </div>
        <!-- Hero Area Start-->
        <div class="slider-area">
            <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="{{ asset($cover_image) }}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                @if ($isEditing)
                                    <h2>Company Name</h2>
                                    <input class="form-control about-name-input" type="text" name="name" value="{{ $name }}">
                                @else
                                    <h2 class="custom-word-wrap">{{ $name }}</h2>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End -->
        <div class="section-top-border">
            <div class="container">
                <h2 class="about-label label-color-pink mb-30">Introduction</h2>
                <div class="row">
                    <div class="col mt-sm-20">
                        @if ($isEditing)
                            <textarea class="form-control about-desc" name="description" cols="102" rows="10">{{ $description }}</textarea>
                        @else
                            <p class="about-desc custom-word-wrap">{!! nl2br($description) !!}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- Support Company End-->
        <!-- How  Apply Process Start-->
        <div class="apply-process-area apply-bg" data-background="{{ asset('img/gallery/how-applybg.png') }}">
            <div class="container">
                <div class="row">
                    <div class="col pt-150 pb-150 custom-50-width">
                        <!-- Section Tittle -->
                        <div class="row">
                            <div class="section-tittle white-text text-center">
                                <h2>Contact</h2>
                            </div>
                        </div>
                        <!-- Apply Process Caption -->
                        <div class="row">
                            <div>
                                <ul class="info-list">
                                    <li class="info-item d-flex">
                                        <label class="about-input-label">Address:</label>
                                        @if ($isEditing)
                                            <input class="form-control about-info-input" type="text" name="address" value="{{ $address }}">
                                        @else
                                            <span class="about-info-input custom-word-wrap">{{ $address }}</span>
                                        @endif
                                    </li>
                                    <li class="info-item d-flex">
                                        <label class="about-input-label">Website:</label>
                                        @if ($isEditing)
                                            <input class="form-control about-info-input" type="text" name="website" value="{{ $website }}">
                                        @else
                                            <span class="about-info-input custom-word-wrap">{{ $website }}</span>
                                        @endif
                                    </li>
                                    <li class="info-item d-flex">
                                        <label class="about-input-label">Phone:</label>
                                        @if ($isEditing)
                                            <input class="form-control about-info-input" type="text" name="phone" value="{{ $phone }}">
                                        @else
                                            <span class="about-info-input custom-word-wrap">{{ $phone }}</span>
                                        @endif
                                    </li>
                                    <li class="info-item d-flex">
                                        <label class="about-input-label">Email:</label>
                                        <span class="about-info-input custom-word-wrap">{{ $email }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col custom-50-width">
                        <div id="company-location"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- How  Apply Process End-->
    </form>
</main>
@endsection
