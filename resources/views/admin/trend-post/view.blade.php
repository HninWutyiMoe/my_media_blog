@extends('admin.layouts.app')
@section('content')
    <div class="card col-10 offset-1 mt-3">
        <div class="card-header bg-gradient-navy p-2">
            <a href="{{ route('admin#trendPost') }}">
                <i class="fa-regular fa-circle-left ml-3 mt-3" style="font-size: 25px"></i>
            </a>
            <legend class="text-center"> View Detail For "{{ $post->title }}"</legend>
        </div>
         <div class="card-bod bg-gradient-primary">
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
                    <div class="row my-4">
                        <div class="offset-1 col-4">
                            <img class="rounded shadow-sm" width="200px" height="160px"
                                @if ($post->image == null) src="{{ asset('photo/null.png') }}"
                                        @else
                                        src="{{ asset('postImage/' . $post->image) }}" @endif>
                        </div>
                        <div class=" offset-1 col-5 ">
                            @if ($post->video == null) <img src="{{ asset('photo/video.png') }}" class="rounded shadow-sm" width="200px" height="160px">
                            @else
                            <iframe src="{{ asset('postVideo/' . $post->video) }}" class="col-12"></iframe>
                            @endif
                        </div>
                    </div>
                    <div class="col-10 offset-1 mb-3">
                        <h5 class="text-warning fw-bold">Title : {{ $post->title }}</h5>
                        <h5 class="text-warning fw-bold">Category : {{ $post->c_name }}</h5>
                        <h5 class="text-warning fw-bold">Description : </h5><div class=" overflow-auto">{{ $post->description }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
