@extends('user.layouts.master')


@section('content')

    <div class="container mt-5" style="width:800px">
        @if (session('sendSuccessful'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class=" fa-solid fa-check"></i> {{ session('sendSuccessful') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
        <h1 class="text-center mb-4">Contact Us</h1>
        <div class="row justify-content-center " >
            <div class="col-md-8 " >
                <form class="contact-form" action="{{ route('user#send',Auth::user()->id) }}" method="post">
                    @csrf
                    <div class="form-group m-3">
                        <label class="control-label mb-1">Name</label>
                        <input id="cc-pament" name="name" type="text" placeholder="Enter your name"
                            class="form-control @error('name')is-invalid @enderror"aria-required="true"
                            aria-invalid="false" placeholder="Enter Admin Email">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group m-3">
                        <label class="control-label mb-1">Email</label>
                        <input id="cc-pament" name="email" type="email" placeholder="Enter your email"
                            class="form-control  @error('email')is-invalid @enderror"aria-required="true"
                            aria-invalid="false" placeholder="Enter Admin Email">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group m-3">
                        <label class="control-label mb-1">Message</label>
                        <textarea name="message" class="form-control @error('message')is-invalid @enderror" cols="20" rows="8"
                            placeholder="Enter Admin Message"></textarea>
                        @error('message')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary float-right  m-3">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
