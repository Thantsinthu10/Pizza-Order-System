@extends('admin.layouts.master')

@section('title', 'Account Profile Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-5">
                                <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                            </div>
                        {{-- <div class="ms-5">
                            <a href="{{ route('product#list') }}">
                                <i class="fa-solid fa-arrow-left text-dark"></i>
                            </a>
                         </div> --}}
                            <div class="card-title">
                                <h3 class="text-center title-2">Update Pizza</h3>
                            </div>

                            <hr>
                            <form action="{{ route('product#update') }}" method="Post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1 ">
                                        <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                            <img src="{{ asset('storage/'.$pizza->image) }}" class="img-thumbnail shadow-sm" />
                                        <div class="mt-3">
                                            <input type="file" name="pizzaImage" class="form-control @error('pizzaImage')is-invalid @enderror">
                                            @error('pizzaImage')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>

                                        <div class="mt-3">
                                            <button class="btn bg-dark text-white col-12" type="submit">
                                                <i class="fa-solid fa-circle-chevron-right me-1"></i> Update
                                            </button>
                                        </div>

                                    </div>
                                    <div class="col-6 ">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="pizzaName" type="text"
                                                value="{{ old('pizzaName',$pizza->name) }}" class="form-control  @error('pizzaName')is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Name">
                                                @error('pizzaName')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Description</label>
                                            <textarea name="pizzaDescription" class="form-control @error('pizzaDescription')is-invalid @enderror" cols="30" rows="10" placeholder="Enter Description">{{ old('pizzaDescription', $pizza->description) }}</textarea>
                                            @error('pizzaDescription')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Category</label>
                                            <select name="pizzaCategory" class="form-control @error('pizzaCategory')is-invalid @enderror" id="">
                                                <option value="">Choose Category...</option>
                                                @foreach ($category as $c)
                                                <option value="{{ $c->id }}"@if ($pizza->category_id == $c->id) selected @endif> {{ $c->name }} </option>
                                                @endforeach
                                           </select>
                                           @error('pizzaCategory')
                                           <div class="invalid-feedback">
                                               {{ $message }}
                                           </div>
                                       @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="pizzaPrice" type="number"
                                                value="{{ old('pizzaPrice',$pizza->price) }}" class="form-control  @error('pizzaPrice')is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Price">
                                                @error('pizzaPrice')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-group">
                                                <label class="control-label mb-1">Waiting Time</label>
                                                <input id="cc-pament" name="pizzaWaitingTime" type="number"
                                                    value="{{ old('pizzaWaitingTime',$pizza->waiting_time) }}" class="form-control  @error('pizzaWaitingTime')is-invalid @enderror"
                                                    aria-required="true" aria-invalid="false" placeholder="Enter Waiting Time">
                                                    @error('pizzaWaitingTime')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                                <div class="form-group">
                                                    <label class="control-label mb-1">View Count</label>
                                                    <input id="cc-pament" name="viewCount" type="text"
                                                        value="{{ old('viewCount',$pizza->view_count) }}" class="form-control @error('viewCount')is-invalid @enderror"
                                                        aria-required="true" aria-invalid="false" disabled>
                                                        @error('viewCount')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Created Date</label>
                                            <input id="cc-pament" name="created_at" type="text"
                                                value="{{ $pizza->created_at->format('j F Y') }}"
                                                class="form-control "aria-required="true" aria-invalid="false" disabled>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
