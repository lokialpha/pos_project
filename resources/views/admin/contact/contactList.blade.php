@extends('admin.layout.master')

@section('title','Category')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Contact Lists</h2>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <h3><i class="fa-solid fa-folder-open mr-2"></i></h3>
                        </div>

                        {{-- search box --}}
                        {{-- <div class="col-3 offset-6 mb-4">
                            <form action="{{ route('user#MessageList') }}" method="get">
                                <div class="d-flex">
                                    <input type="search" class=" form-control" name="key" value="{{ request('key') }}" placeholder="Search..">
                                    <button class="btn btn-dark text-white" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div> --}}
                    </div>
                    <div class="table-responsive table-responsive-data2 mt-3">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                            <tbody id="dataList">
                                @foreach ($messages as $m)
                                <tr class="tr-shadow">
                                    <td class="col-2">{{ $m->id }}</td>
                                    <td class="col-3">{{ $m->name }}</td>
                                    <td class="col-3">{{ $m->email }}</td>
                                    <td class="col-5">{{ $m->message }}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{ route('user#deleteContact', $m->id) }}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="">
                            {{ $users->links() }}
                        </div> --}}
                    </div>
                <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
