@extends('admin.layouts.master')

@section('title', 'Order List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    @if (session('updateSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class=" fa-solid fa-check"></i> {{ session('updateSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class=" fa-solid fa-check"></i> {{ session('deleteSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    <div class="row my-2 ms-1">
                        <div class="col-1  bg-white shadow-sm p-2 text-center ">
                            <h3> <i class="fa-solid fa-users me-2"></i><span class="m-2">{{ $users->total() }}</span>
                            </h3>
                        </div>
                    </div>

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
                            <tbody id="dataList">

                                @foreach ($users as $u)
                                    <tr>
                                        <input type="hidden" class="userId" value="{{ $u->id }}">
                                        <td class="col-2">
                                            @if ($u->image == null)
                                                @if ($u->gender == 'male')
                                                    <img src="{{ asset('image/default_user.webp') }}"
                                                        class="img-thumbnail shadow-sm">
                                                @else
                                                    <img src="{{ asset('image/female_default_user.webp') }}"
                                                        class="img-thumbnail shadow-sm">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $u->image) }}" />
                                            @endif
                                        </td>
                                        <td>{{ $u->name }}</td>
                                        <td>{{ $u->email }}</td>
                                        <td>{{ $u->gender }}</td>
                                        <td>{{ $u->phone }}</td>
                                        <td>{{ $u->address }}</td>
                                        <td class="col-2">
                                            <select name="role" class="form-control roleChange" id="">
                                                <option value="admin" @if ($u->role == 'admin') selected @endif>
                                                    Admin</option>
                                                <option value="user" @if ($u->role == 'user') selected @endif>
                                                    User</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                @if (Auth::user()->id == $u->id)
                                                @else
                                                    <a href="{{ route('admin#editUserAccount', $u->id) }}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                    </a>
                                                    <a href=" {{ route('admin#deleteUserAccount', $u->id) }} ">
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
                        <div class="mt-5">
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
        $(document).ready(function() {
            $('.roleChange').change(function() {
                $currentRole = $(this).val();
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('.userId').val();

                $data = {
                    'role': $currentRole,
                    'userId': $userId
                };
                console.log($data);

                $.ajax({
                    type: 'get',
                    url: 'http://localhost:8000/user/change/role',
                    data: $data,
                    dataType: 'json',
                })
                location.reload();
            })
        })
    </script>
@endsection
