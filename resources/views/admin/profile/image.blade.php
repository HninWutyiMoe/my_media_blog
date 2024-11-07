@extends('admin.layouts.app')
@section('content')
    <div class="card bg-gradient-yellow col-8 offset-2 mt-3">
        <div class="card-header p-2">
            <a href="{{ route('dashboard') }}">
                <i class="fa-regular fa-circle-left" style="font-size: 25px"></i>
            </a>
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

                    <form action="{{ route('update#profile') }}" enctype="multipart/form-data" method="POST"
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

                        <div class="row form-group">
                            <label class="col-2"></label>
                            <div class="col-sm-9">
                                <input type="file" name="profile" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success col-4 offset-4">Change Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
