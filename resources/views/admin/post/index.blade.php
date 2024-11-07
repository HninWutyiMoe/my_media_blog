@extends('admin.layouts.app')
@section('content')
    <!-- Main content -->
    <div class="col-4">
        <div class="card bg-gradient-success mt-3">

            <div class="card-body">

                <form action="{{ route('post#create') }}" method="POST" enctype="multipart/form-data">
                    {{-- @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    @endif --}}
                    @csrf
                    <div class="form-group">
                        <label for="">Post Image</label>
                        <input name="postImage" type="file" class="form-control">

                    </div>

                    <div class="form-group">
                        <label for="">Post Video</label>
                        <input name="postVideo" type="file" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Post Name</label>
                        <input name="postName" type="text" class="form-control" placeholder="Enter category name...">
                        @error('postName')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Category Name</label>
                        <select name="categoryName" class="form-control" aria-label="Default select example">
                            <option value="">Choose category</option>
                            @foreach ($category as $c)
                                <option value="{{ $c->id }}">{{ $c->title }}</option>
                            @endforeach
                        </select>
                        @error('categoryName')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Country Name</label>
                        <select name="countryName" class="form-control" aria-label="Default select example">
                            <option value="">Choose country</option>
                            @foreach ($country as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                        @error('countryName')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" cols="20" rows="5" placeholder="Enter Description..." class="form-control"></textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-warning col-6 offset-3">Add <i class="fa-solid fa-plus ml-1"></i></button>
                </form>

            </div>
        </div>
    </div>

    <div class="col-8 mt-3">
        {{-- Create Alert --}}
        @if (Session::has('createdSuccess'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ Session::get('createdSuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- Update Alert --}}
        @if (Session::has('updateSuccess'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                {{ Session::get('updateSuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (Session::has('deleteSuccess'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('deleteSuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card">
            <div class="card-header bg-gradient-yellow">
                <h3 class="card-title">Post Table</h3>

                <div class="card-tools">
                    <form action="{{ route('post#search') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" value="{{ request('search') }}" name="search"
                                class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->

            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr class="shadow-sm">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Country</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($post as $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->title }}</td>
                                <td>
                                    <img class="rounded shadow-sm" width="90px" height="80px"
                                        @if ($p->image == null) src="{{ asset('photo/null.png') }}"
                                        @else src="{{ asset('postImage/' . $p->image) }}" @endif>
                                </td>
                                <td>{{ $p->category}}</td>
                                <td>{{ $p->country }}</td>
                                <td>
                                    <div class="table-data-feature">

                                        <a href="{{ route('post#view', $p->id) }}" class="me-3">
                                            <button class="item bg-gradient-blue" data-toggle="tooltip" data-placement="top"
                                                title="View Details">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </a>

                                        <a href="{{ route('post#edit', $p->id) }}" class="me-3">
                                            <button class="item bg-gradient-yellow" data-toggle="tooltip"
                                                data-placement="top" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </a>

                                        <a href="{{ route('post#delete', $p->id) }}" class="me-2">
                                            <button class="item bg-gradient-red" data-toggle="tooltip"
                                                data-placement="top" title="Delete">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3 d-flex justify-content-center">
                {{ $post->links() }}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.content -->
@endsection
