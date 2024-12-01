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
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Profile</h3>
                            </div>

                            <hr>
                            <form action="{{ route('admin#updateUserAccount', $user->id) }}" method="Post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1 ">
                                        @if ($user ->image == null)
                                            @if ($user ->gender == 'male')
                                                <img src="{{ asset('image/default_user.webp') }}"
                                                    class="img-thumbnail shadow-sm">
                                            @else
                                                <img src="{{ asset('image/female_default_user.webp') }}"
                                                    class="img-thumbnail shadow-sm">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . $user ->image) }}"  class="img-thumbnail shadow-sm"/>
                                        @endif
                                        <div class="mt-3">
                                            <input type="file" name="image"
                                                class="form-control @error('image')is-invalid @enderror">
                                            @error('image')
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
                                            <input id="cc-pament" name="name" type="text"
                                                value="{{ old('name', $user ->name) }}"
                                                class="form-control  @error('name')is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Admin Name">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="email"
                                                value="{{ old('email', $user ->email) }}"
                                                class="form-control  @error('email')is-invalid @enderror"aria-required="true"
                                                aria-invalid="false" placeholder="Enter Admin Email">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="number"
                                                value="{{ old('phone', $user ->phone) }}"
                                                class=" form-control @error('phone')is-invalid @enderror
                                                "aria-required="true"
                                                aria-invalid="false" placeholder="Enter Admin Phone">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control @error('gender')is-invalid @enderror"
                                                id="">
                                                <option value="">Choose Gender...</option>
                                                <option value="male" @if ($user ->gender == 'male') selected @endif>
                                                    male</option>
                                                <option value="female" @if ($user ->gender == 'female') selected @endif>
                                                    female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <textarea name="address" class="form-control @error('address')is-invalid @enderror" cols="30" rows="10"
                                                placeholder="Enter Admin Address">{{ old('address', $user ->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
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
