@extends('layouts.app')

@section('content')
    
    @include('layouts/header')

            <div class="container-fluid page__heading-container">
                <div class="page__heading">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="material-icons icon-20pt">home</i></a></li>
                            <li class="breadcrumb-item">Users</li>
                            <li class="breadcrumb-item active"
                                aria-current="page">Add</li>
                        </ol>
                    </nav>

                    <h1 class="m-0">Add User</h1>
                </div>
            </div>

            <div class="container-fluid page__container">
                <form action="{{ url('create/user/request') }}" method="POST">
                @csrf
                <div class="card card-form">
                    @include('layouts/error') 
                    <div class="row no-gutters">
                        <div class="col-lg-3 card-body">
                            <p><strong class="headings-color">Login Info</strong></p>
                            <!--
                            <p class="text-muted">CRM supports all of Bootstrap's default form styling in addition to a handful of new input types and features. Please <a href="https://getbootstrap.com/docs/4.1/components/forms/"
                                   target="_blank">read the official documentation</a> for a full list of options from Bootstrap's core library.</p>
                            -->
                        </div>
                        <div class="col-lg-9 card-form__body card-body">                
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password:</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>
                    </div>    
                </div>
                <div class="card card-form">
                    <div class="row no-gutters">
                        <div class="col-lg-3 card-body">
                            <p><strong class="headings-color">Personal Info</strong></p>
                        </div>
                        <div class="col-lg-9 card-form__body card-body">                
                            <div class="form-group">
                                <label for="user_first_name">First name:</label>
                                <input type="text" class="form-control @error('user_first_name') is-invalid @enderror" id="user_first_name" name="user_first_name">
                            </div>
                            <div class="form-group">
                                <label for="user_last_name">last name:</label>
                                <input type="text" class="form-control @error('user_last_name') is-invalid @enderror" id="user_last_name" name="user_last_name">
                            </div>
                            <div class="form-group">
                                <label for="user_full_name">Full name:</label>
                                <input type="text" class="form-control @error('user_full_name') is-invalid @enderror" id="user_full_name" name="user_full_name">
                            </div>
                            <div class="form-group">
                                <div class="row m-0">
                                    <div class="col-sm-6">
                                        <label>Gender</label>
                                        <select class="form-control">
                                            <option value="" selected="">-select-</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Role</label>
                                        <select class="form-control">
                                            <option value="" selected="">-select-</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
                <div class="card card-form">
                    <div class="row no-gutters">
                        <div class="col-12 card-form__body card-body">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

    @include('layouts/menu')
    @include('layouts/footer')

@endsection