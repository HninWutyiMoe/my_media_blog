@extends('admin.layouts.app')
@section('content')
    <div class="card bg-gradient-gray-dark col-8 offset-2 mt-3">
        <div class="card-header p-2">
            <legend class="text-center">Profile</legend>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane">
                    {{-- Alert --}}
                    @if (Session::has('alertSuccess'))
                        <div class="alert alert-default-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ Session::get('alertSuccess') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('profile#update') }}" enctype="multipart/form-data" method="POST"
                        class="form-horizontal">

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        @endif
                        @csrf
                        <div class="col-4 offset-4 mb-3">

                            <input type="hidden" name="userId" value="{{ Auth::user()->id }}">

                            @if (Auth::user()->image == null)
                                @if (Auth::user()->gender == 'male')
                                    <img src="{{ asset('photo/default.png') }}" class="shadow-sm img-thumbnail"
                                        style="width:150px; height:130px; border-radius: 50%">
                                @else
                                    <img src="{{ asset('photo/image.png') }}" class="shadow-sm img-thumbnail"
                                        style="width:150px; height:130px; border-radius: 50%">
                                @endif
                            @else
                                <img src="{{ asset('storage/' . Auth::user()->image) }}" class="shadow-sm img-thumbnail"
                                    style="width:150px; height:130px; border-radius: 50%">
                            @endif

                        </div>

                        <div class="text-white col-6 offset-3 mb-4">
                            Do you want to change your profile?
                            <a href="{{ route('change#profile') }}" class="text-warning">Click here...</a>
                        </div>

                        <div class="row form-group">
                            <label class="col-3">Name :</label>
                            <div class="col-sm-9">
                                <input value="{{ old('userName', $userInfo->name) }}" name="userName" type="text"
                                    class="form-control" placeholder="Enter Name...">
                                @error('userName')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-3">Email :</label>
                            <div class="col-sm-9">
                                <input value="{{ old('userEmail', $userInfo->email) }}" name="userEmail" type="email"
                                    class="form-control" placeholder="Enter Email...">
                                @error('userEmail')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-3">Phone :</label>
                            <div class="col-sm-9">
                                <input value="{{ old('userPhone', $userInfo->phone) }}" name="userPhone" type="number"
                                    class="form-control" placeholder="Enter Phone...">
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-3">Address :</label>
                            <div class="col-sm-9">
                                <textarea name="userAddress" class="form-control" cols="20" rows="5" placeholder="Enter Address...">{{ $userInfo->address }}</textarea>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-3">Gender :</label>
                            <div class="col-sm-9">
                                <select name="gender" class="form-control">

                                    @if ($userInfo->gender == 'male')
                                        <option value="empty">Choose</option>
                                        <option value="male" selected>Male</option>
                                        <option value="female">Female</option>
                                    @elseif ($userInfo->gender == 'female')
                                        <option value="empty">Choose</option>
                                        <option value="male">Male</option>
                                        <option value="female" selected>Female</option>
                                    @else
                                        <option value="empty">Choose</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-3">Role :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="{{ $userInfo->role }}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-3"></label>

                            <div class="d-flex col-8">
                                <button type="submit" class="btn bg-gradient-orange text-white col-4">Update</button>
                                <a href="{{ route('admin#password') }}" class="pl-3 text-primary">
                                    Change Password
                                </a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
