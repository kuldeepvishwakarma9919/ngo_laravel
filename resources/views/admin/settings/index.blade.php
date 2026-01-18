@extends('admin.masters.layouts.app')


@section('content')
    <div class="container-fluid">

        <h1 class="h4 fw-bold mb-4">Site Settings</h1>

        <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="fw-bold">Site Name</label>
                            <input type="text" name="site_name" class="form-control "
                                value="{{ $setting->site_name ?? '' }}">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="fw-bold">Logo</label>
                            <input type="file" name="logo" class="form-control">
                            @if (!empty($setting->logo))
                                <img src="{{ asset($setting->logo) }}" height="50" class="mt-2">
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $setting->email ?? '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ $setting->phone ?? '' }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Address</label>
                        <textarea name="address" class="form-control">{{ $setting->address ?? '' }}</textarea>
                    </div>


                     <div class="mb-3">
                        <label>Map Address</label>
                        <textarea name="map_location" class="form-control">{{ $setting->map_location ?? '' }}</textarea>
                    </div>

                    <hr>
                    <h6 class="fw-bold">Payment Settings</h6>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" name="payment_key" class="form-control" placeholder="Payment Key"
                                value="{{ $setting->payment_key ?? '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" name="payment_secret" class="form-control" placeholder="Payment Secret"
                                value="{{ $setting->payment_secret ?? '' }}">
                        </div>
                    </div>

                    <hr>
                    <h6 class="fw-bold">Social Links</h6>

                    <div class="row">
                        @foreach (['facebook', 'instagram', 'twitter', 'linkedin', 'youtube', 'tiktok', 'x', 'telegram', 'whatsapp'] as $social)
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="small fw-bold text-muted mb-1">
                                        <i
                                            class="fab fa-{{ $social == 'x' ? 'x-twitter' : ($social == 'whatsapp' ? 'whatsapp' : $social) }} me-1"></i>
                                        {{ ucfirst($social) }} Profile Link
                                    </label>
                                    <input type="text" name="{{ $social }}"
                                        class="form-control shadow-sm border-0 bg-light"
                                        placeholder="Enter {{ ucfirst($social) }} URL"
                                        value="{{ $setting->$social ?? '' }}">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-end mt-3">
                        <button class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Settings
                        </button>
                    </div>

                </div>
            </div>
        </form>

    </div>
@endsection
