@extends('layouts.app')

@section('title', 'TQH Job Listing')

@section('content')
<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4 pr-25">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="{{ asset('img/avatar/default.jpg') }}" alt="avatar"
                        class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3">{{ $name }}</h5>
                        <p class="text-muted mb-1">Age: {{ now()->diff($dob)->y }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row card mb-4">
                    <div class="card-body">
                        <div class="mt-10"></div>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Full Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Date of birth</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $dob }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Gender</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    @switch($gender)
                                        @case(0)
                                            Male
                                            @break
                                        @case(1)
                                            Female
                                            @break
                                    @endswitch
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $email }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Phone</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $phone }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Address</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $address }}</p>
                            </div>
                        </div>
                        <div class="mb-10"></div>
                    </div>
                </div>
                <div class="row card mb-4">
                    <div class="card-body">
                        @if (auth()->guard('user')->check() && auth()->guard('user')->id() == $id)
                            <div class="row justify-content-center mb-20">
                                <form enctype="multipart/form-data" action="{{ route('user.uploadCv') }}" method="POST"
                                    class="flex-grow-1 d-flex justify-content-between align-items-center ml-30 mr-30">
                                    @csrf
                                    <input type="file" name="cv">
                                    <button class="btn head-btn1" type="submit">Save</button>
                                </form>
                            </div>
                        @endif
                        <div class="row justify-content-center">
                            <embed src="{{ asset($cv_url) }}" width="96%" height="1000px" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
