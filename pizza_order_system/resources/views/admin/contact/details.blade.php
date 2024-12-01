@extends('admin.layouts.master')

@section('title', 'Contact Details Page')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="row my-2 ms-1">
                    <div class="col d-flex p-2 text-center ">
                        <a href="{{ route('admin#contactHomePage') }}" class="text-black">
                            <i class="fa-solid fa-arrow-left"> BACK</i>
                        </a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title mb-3">
                            <h4 class=" title-2 ">From {{ $data['name'] }}</h4>
                        </div>
                        <p class="text-muted text-center">
                            {{ $data['message'] }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
