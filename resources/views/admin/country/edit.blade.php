@extends('admin.layouts.app')
@section('content')
    <!-- Main content -->
    <div class="col-4">
        <div class="card bg-gradient-navy mt-3">

            <div class="card-body">

                <form action="{{ route('country#update') }}" method="POST">

                    @csrf

                    <input type="hidden" name="countryId" value={{ $updateCountry->id }}>

                    <div class="form-group">
                        <label for="">country Name</label>
                        <input value="{{ old('countryName', $updateCountry->name) }}" name="countryName" type="text"
                            class="form-control" placeholder="Enter Country name...">
                        @error('countryName')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-10 offset-1">
                        <button type="submit" class="btn btn-warning ">Update<i
                                class="fa-solid fa-pen-to-square ml-1"></i></button>
                        <a href="{{ route('admin#country') }}">
                            <button type="button" class="btn btn-danger ml-3">Create<i
                                    class="fa-regular fa-square-plus ml-1"></i></button>
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="col-8 mt-3">
        {{-- Alert --}}
        @if (Session::has('createdSuccess'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ Session::get('createdSuccess') }}
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
            <div class="card-header bg-gradient-teal">
                <h3 class="card-title">Order Table</h3>

                <div class="card-tools">
                    <form action="{{ route('country#search') }}" method="POST">
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
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($country as $c)
                            <tr>
                                <td> {{ $c->id }} </td>
                                <td> {{ $c->name }} </td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{ route('country#edit', $c->id) }}">
                                            <button class="item bg-gradient-teal" data-toggle="tooltip" data-placement="top"
                                                title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('country#delete', $c->id) }}">
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
