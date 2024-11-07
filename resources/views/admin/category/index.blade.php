@extends('admin.layouts.app')
@section('content')
    <!-- Main content -->
    <div class="col-4">
        <div class="card bg-gradient-navy mt-3">

            <div class="card-body">

                <form action="{{ route('category#add') }}" method="POST">

                    @csrf

                    <div class="form-group">
                        <label for="">Category Name</label>
                        <input name="categoryName" type="text" class="form-control" placeholder="Enter category name...">
                        @error('categoryName')
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

                    <button type="submit" class="btn btn-warning col-6 offset-3">Add<i
                            class="fa-solid fa-plus ml-1"></i></button>
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
            <div class="card-header bg-gradient-purple">
                <h3 class="card-title">Order Table</h3>

                <div class="card-tools">
                    <form action="{{ route('category#search') }}" method="POST">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" value="{{ request('search')  }}" name="search"
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
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $c)
                            <tr>
                                <td>{{ $c->id }}</td>
                                <td>{{ $c->title }}</td>
                                <td>{{ $c->description }}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{ route('category#edit', $c->id) }}">
                                            <button class="item bg-gradient-purple" data-toggle="tooltip"
                                                data-placement="top" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('category#delete', $c->id) }}">
                                            <button class="item bg-gradient-red" data-toggle="tooltip" data-placement="top"
                                                title="Delete">
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
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.content -->
@endsection
