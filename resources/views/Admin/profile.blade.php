<!doctype html>
<html lang="en">


<!-- Mirrored from codervent.com/rocker/demo/vertical/auth-basic-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Apr 2023 09:10:21 GMT -->
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ url('public/images/job-search.png') }}" type="image/png"/>

    <title>Admin profile</title>
</head>

<style>
  .col-md-4.imageClass {
        display: flex;
        justify-content: center;
        align-items: center;
    }

</style>

@extends('Admin.layouts.main')

@section('main-container')
    <div class="page-wrapper">
        <div class="page-content">
            <!-- Admin Profile -->
            <h2>Admin Profile</h2>

            <div class="row">
                <div class="col-md-4 imageClass">
                    <div class="text-center">
                        @if (!empty($admin->image))
                            <img src="{{'../images/'.$admin->image}}" alt="Admin Image" class="rounded-circle" style="width: 150px; height: 150px;">
                        @else
                            <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center" style="width: 150px; height: 150px; font-size: 24px;">
                                No Image
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-8">
                    <form method="POST" action="{{ route('admin.profileUpdate', ['id' => Auth::guard('admin')->id()]) }}">
                        @csrf
                        @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $admin->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $admin->email }}" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" class="form-control" value="{{ $admin->phone }}">
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="text" id="image" name="image" class="form-control" value="{{ $admin->image }}">
                        </div>

                        <!-- Password fields -->
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" value="{{ $admin->password }}" placeholder="Enter new password">
                        </div>

                        <!-- Add more fields as needed -->

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
        // Automatically hide success and error messages after 3 seconds
        if ($('.alert-success').length > 0) {
            setTimeout(function() {
                $('.alert-success').fadeOut('slow');
            }, 5000);
        }
        if ($('.alert-danger').length > 0) {
            setTimeout(function() {
                $('.alert-danger').fadeOut('slow');
            }, 5000);
        }
    });
    </script>

@endsection
