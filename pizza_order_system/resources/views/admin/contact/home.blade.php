@extends('admin.layouts.master')

@section('title', 'Contact List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30 d-flex">
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
                    <div class="row my-2 ms-1">
                        <div class="col-1  bg-white shadow-sm p-2 text-center ">
                            <h3> <i class="fa-solid fa-envelope me-2"></i><span class="m-2">{{ $contact->total() }}</span>
                            </h3>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center ">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Contact Date</th>
                                    <th class=""></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contact as $c)
                                    <tr class="tr-shadow">
                                        <td></td>
                                        <td class="col-2">{{ $c->name }}</td>
                                        <td>{{ $c->email }}</td>
                                        <td>{{ Str::of($c->message)->words(10, ' ...') }}</td>
                                        <td>{{ $c->created_at->format('j-F-Y') }} </td>
                                        <td>
                                            <div class="table-data-feature">
                                                    <a href="{{ route('admin#detailsContact', $c->id) }}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                            title="View">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('admin#deleteMessage', $c->id) }} ">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $contact->links() }}
                            {{-- {{ $contact->appends(request()->query())->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
