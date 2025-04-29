<?php
$columnName = "image";
?>

@extends('backend.master.main')
@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Admin Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            @if($adminData->image)
                                <img src="{{url($adminData->image)}}" alt="Profile" class="rounded-circle">
                            @endif
                            x <h2>
                                {{$adminData->name}}
                            </h2>
                            <h3>
                                {{$adminData->email}}
                            </h3>
                            <div class="social-links mt-2">
                                <a href="{{$adminData->facebook}}" target="_blank" class="facebook"><i
                                        class="bi bi-facebook"></i></a>
                                <a href="{{$adminData->twitter}}" target="_blank" class="twitter"><i
                                        class="bi bi-twitter"></i></a>
                                <a href="{{$adminData->instagram}}" target="_blank" class="instagram"><i
                                        class="bi bi-instagram"></i></a>
                                <a href="{{$adminData->linkedin}}" target="_blank" class="linkedin"><i
                                        class="bi bi-linkedin"></i></a>
                                <a href="{{$adminData->youtube}}" target="_blank" class="youtube"><i
                                        class="bi bi-youtube"></i></a>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#profile-overview">Overview
                                    </button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">


                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">About</h5>
                                    <p class="small fst-italic">
                                        {{$adminData->description}}
                                    </p>

                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{$adminData->name}}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{$adminData->email}}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Account Position</div>
                                        <div class="col-lg-9 col-md-8">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Role</div>
                                        <div class="col-lg-9 col-md-8">
                                            @foreach($adminData->allRoles as $role)
                                                {{$role->name}}
                                            @endforeach
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Address</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{$adminData->address}}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{$adminData->phone}}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Website</div>
                                        <div class="col-lg-9 col-md-8">
                                            <a href="{{$adminData->website}}" target="_blank">{{$adminData->website}}</a>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>

                    </div>
                </div>
        </section>

    </main><!-- End #main -->

@endsection
