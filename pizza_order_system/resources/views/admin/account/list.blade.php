@extends('admin.layouts.master')

@section('title', 'Admin List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class=" fa-solid fa-check"></i> {{ session('deleteSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-3">
                            <h4 class="text-secondary">Search Key : <span class=" text-danger">{{ request('key') }}</span>
                            </h4>
                        </div>
                        <div class=" col-3 offset-6">
                            <form action="{{ route('admin#list') }}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" value="{{ request('key') }}"
                                        placeholder="search..." class="form-control">
                                    <button class="btn bg-dark text-white" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-1 offset-10 bg-white shadow-sm p-2 text-center ">
                            <h3> <i class="fa-solid fa-users me-2"></i><span class="m-2">{{ $admin->total() }}</span></h3>
                        </div>
                    </div>

                    {{-- @if (count($categories) != 0) --}}

                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center ">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Role</th>
                                        <th> </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admin as $a)
                                        <tr class="tr-shadow">
                                            <input type="hidden" class="userId" value="{{ $a->id }}">
                                            <td class="col-2">
                                                @if ($a->image == null)
                                                    @if ($a->gender == 'male')
                                                        <img src="{{ asset('image/default_user.webp') }}" class="img-thumbnail shadow-sm">
                                                    @else
                                                    <img src="{{ asset('image/female_default_user.webp') }}" class="img-thumbnail shadow-sm">
                                                     @endif
                                                @else
                                                <img src="{{ asset('storage/'. $a->image ) }}" class="img-thumbnail shadow-sm">
                                                @endif
                                            </td>
                                            <td>{{ $a->name }}</td>
                                            <td>{{ $a->email }}</td>
                                            <td>{{ $a->gender }}</td>
                                            <td>{{ $a->phone }}</td>
                                            <td>{{ $a->address }}</td>
                                            <td class="col-2">
                                                <div class="table-data-feature">
                                                    @if (Auth::user()->id == $a->id)

                                                    @else
                                                <select name="role" class="form-control roleChange" id="">
                                                    <option value="admin" @if ($a->role == 'admin') selected @endif> Admin</option>
                                                    <option value="user" @if ($a->role == 'user') selected @endif> User</option>
                                                </select>
                                                @endif
                                            </div>
                                             </td>
                                            <td>
                                                <div class="table-data-feature">
                                                    @if (Auth::user()->id == $a->id)

                                                    @else
                                                         {{-- <a href="{{ route('admin#changeRole',$a->id) }} ">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                            title="Change Admin Role">
                                                            <i class="fa-solid fa-person-circle-minus"></i>
                                                        </button>
                                                        </a> --}}
                                                        <a href=" {{ route('admin#delete',$a->id) }} ">
                                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                                title="Delete">
                                                                <i class="fa-solid fa-trash-can"></i>
                                                            </button>
                                                            </a>
                                                    @endif

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $admin->links() }}
                                {{-- {{ $categories->appends(request()->query())->links() }} --}}
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
            $('.roleChange').change(function(){
                $currentRole = $(this).val();
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('.userId').val();

                $data = {
            'role' : $currentRole,
            'userId' : $userId
        };
        console.log($data);

        $.ajax({
        type : 'get' ,
        url : 'http://localhost:8000/account/changeRole',
        data : $data,
        dataType : 'json',
    })
    location.reload();
            })


        })
    </script>
@endsection
