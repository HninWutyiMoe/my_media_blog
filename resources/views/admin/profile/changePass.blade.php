@extends('admin.layouts.app')
@section('content')
    <div class="card bg-gradient-navy col-9 offset-2 mt-3">
        <div class="card-header p-2">
            <a href="{{ route('dashboard') }}">
                <i class="fa-regular fa-circle-left" style="font-size: 25px"></i>
            </a>
            <legend class="text-center">Change Password</legend>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane">
                    {{-- Alert --}}
                    @if (Session::has('changeSuccess'))
                        <div class="alert alert-default-success alert-dismissible fade show" role="alert">
                            {{ Session::get('changeSuccess') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (Session::has('notMatch'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ Session::get('notMatch') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('update#pass') }}" method="POST" class="form-horizontal">
                        @csrf

                        <div class="row form-group">
                            <label class="col-4">Old Password :</label>
                            <div class="col-sm-8">
                                <input value="" name="oldPassword" type="password" class="form-control"
                                    placeholder="Enter Old Password...">
                                @error('oldPassword')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-4">New Password :</label>
                            <div class="col-sm-8">
                                <input value="" name="newPassword" type="password" class="form-control"
                                    placeholder="Enter New Password...">
                                @error('newPassword')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-4">Confirm Password :</label>
                            <div class="col-sm-8">
                                <input value="" name="confirmPassword" type="password" class="form-control"
                                    placeholder="Enter Confirm Password ...">
                                @error('confirmPassword')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-4"></label>
                            <button type="submit" class="btn bg-gradient-purple">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
