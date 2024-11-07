@extends('admin.layouts.app')
@section('content')
    <!-- Main content -->
    <section class="content col-12">
        <div class="row mt-4">
            {{-- Alert --}}
            @if (Session::has('deleteSuccess'))
                <div class="alert alert-default-success alert-dismissible fade show" role="alert">
                    {{ Session::get('deleteSuccess') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User Table</h3>

                        <div class="card-tools">

                            <form action="{{ route('admin#search') }}" method="POST">
                                @csrf
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="search" value="{{ request('search') }}" class="form-control float-right"
                                        placeholder="Search">

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
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $u)
                                    <tr>
                                        <td>{{ $u->id }}</td>

                                        @if (Auth::user()->id == $u->id)
                                            <td class="text-primary bold">{{ $u->name }}(You)</td>
                                        @else
                                            <td>{{ $u->name }}</td>
                                        @endif

                                        <td>{{ $u->email }}</td>
                                        <td>{{ $u->phone }}</td>
                                        <td>{{ $u->address }}</td>

                                        <td>
                                            @if (Auth::user()->id == $u->id)
                                                {{-- <a href="">
                                                    <button class="btn btn-sm bg-dark text-white">
                                                        <i class="fas fa-edit"></i></button>
                                                </a> --}}
                                            @else
                                                <a href="{{ route('admin#delete', $u->id) }}">
                                                    <button class="btn btn-sm bg-danger text-white"><i
                                                            class="fas fa-trash-alt"></i></button>
                                                </a>
                                            @endif
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
        </div>
    </section>
    <!-- /.content -->
@endsection
