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
                                <h2 class="title-1">User Lists</h2>
                            </div>
                        </div>
                    </div>
                    {{-- alert box --}}
                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-check mr-2"></i> {{ session('deleteSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-3">
                            <h3><i class="fa-solid fa-folder-open mr-2"></i> {{ $users->total() }}</h3>
                        </div>

                        {{-- search box --}}
                        <div class="col-3 offset-6 mb-4">
                            <form action="{{ route('admin#userList') }}" method="get">
                                <div class="d-flex">
                                    <input type="search" class=" form-control" name="key" value="{{ request('key') }}" placeholder="Search..">
                                    <button class="btn btn-dark text-white" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2 mt-3">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                            <tbody id="dataList">
                                @foreach ($users as $user)
                                <tr class="tr-shadow">
                                    <input type="hidden" class="userId" value="{{ $user->id }}">
                                    <td class="col-2">
                                        @if ($user->image==null)
                                            @if ($user->gender=='male')
                                                <img src="{{ asset('image/default_male_pf.png') }}" class="img-thumbnail shadow-sm"/>
                                            @else
                                                <img src="{{ asset('image/default_female_pf.png') }}" class="img-thumbnail shadow-sm"/>
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/'.$user->image) }}" class="img-thumbnail shadow-sm"/>
                                        @endif

                                    </td>
                                    <td class="col-1">{{ $user->name }}</td>
                                    <td class="col-2">{{ $user->email }}</td>
                                    <td class="col-1">{{ $user->gender }}</td>
                                    <td class="col-2">{{ $user->phone }}</td>
                                    <td class="col-2">{{ $user->address }}</td>
                                    <td class="col-2">
                                        <select class=" form-control statusChange">
                                            <option value="user" selected>User</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{ route('admin#userEdit',$user->id) }}" class="me-2">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('admin#userDelete',$user->id) }}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="">
                            {{ $users->links() }}
                        </div>
                    </div>
                <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection


@section('scriptSource')

<script>
    $(document).ready(function(){
        // change status
        $('.statusChange').change(function(){
            $currentStatus = $(this).val();
            $parentNode = $(this).parents("tr");
            $userId = $parentNode.find('.userId').val();

            $.ajax({
                type : 'get',
                url : '/user/changeRole',
                data : {
                    'userId' : $userId ,
                    'role' : $currentStatus
                },
                dataType : 'json',
            });
            location.reload();
        })
    });
</script>

@endsection

