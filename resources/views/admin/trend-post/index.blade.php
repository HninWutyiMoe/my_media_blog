@extends('admin.layouts.app')
@section('content')
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Trend Posts Table</h3>

                <div class="card-tools">
                    <form action="{{ route('trendPost#search') }}" method="POST" enctype="multipart/form-data">
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
                        <tr>
                            <th>ID</th>
                            <th>Post Name</th>
                            <th>Image</th>
                            <th>View Count</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $t)
                            <tr>
                                <td>{{ $t->id }}</td>
                                <td>{{ $t->title }}</td>
                                <td>
                                    <img class="rounded shadow-sm" width="90px" height="80px"
                                        @if ($t->image == null) src="{{ asset('photo/null.png') }}"
                                    @else src="{{ asset('postImage/' . $t->image) }}" @endif>
                                </td>
                                <td>
                                    {{ $t->view_count }}
                                    <i class="fa-solid fa-eye ml-1"></i>
                                </td>
                                <td>
                                    <a href="{{route('trend#view',$t->id)}}">
                                        <button class="btn btn-sm bg-gradient-purple text-white">
                                            <i class="fa-solid fa-file-lines"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3 d-flex justify-content-center">
                {{ $data->links() }}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
