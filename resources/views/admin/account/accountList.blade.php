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
                                <h2 class="title-1">Admins List</h2>
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

                    @if (session('changeRoleSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-check mr-2"></i> {{ session('changeRoleSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-3">
                            <h3><i class="fa-solid fa-folder-open mr-2"></i> {{ $admin->total() }}</h3>
                        </div>

                        {{-- search box --}}
                        <div class="col-3 offset-6 mb-4">
                            <form action="{{ route('admin#list') }}" method="get">
                                <div class="d-flex">
                                    <input type="search" class=" form-control" name="key" value="{{ request('key') }}" placeholder="Search..">
                                    <button class="btn btn-dark text-white" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                        <div class="table-responsive table-responsive-data2">
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
                                <tbody>
                                    @foreach ($admin as $a)
                                    <tr class="tr-shadow">
                                        <input type="hidden" class="userId" value="{{ $a->id }}">
                                        <td class="col-2">
                                            @if ($a->image==null)
                                                @if ($a->gender=='male')
                                                    <img src="{{ asset('image/default_male_pf.png') }}" class="img-thumbnail shadow-sm"/>
                                                @else
                                                    <img src="{{ asset('image/default_female_pf.png') }}" class="img-thumbnail shadow-sm"/>
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/'.$a->image) }}" class="img-thumbnail shadow-sm"/>
                                            @endif

                                        </td>
                                        <td class="col-1">{{ $a->name }}</td>
                                        <td class="col-2">{{ $a->email }}</td>
                                        <td class="col-1">{{ $a->gender }}</td>
                                        <td class="col-2">{{ $a->phone }}</td>
                                        <td class="col-2">{{ $a->address }}</td>
                                        <td class="col-2">
                                            <div >
                                                @if (Auth::user()->id == $a->id)
                                                @else
                                                    <select class=" form-control statusChange">
                                                        <option value="user">User</option>
                                                        <option value="admin" selected>Admin</option>
                                                    </select>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                @if (Auth::user()->id == $a->id)
                                                @else
                                                    <a href="{{ route('admin#delete',$a->id) }}">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="">
                                {{ $admin->links() }}
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
