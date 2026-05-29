@extends('SuperAdmin.layouts.admin')

@section('title')
    Settings
@endsection

@section('content')

    <div class="container-fluid">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="fw-bold mb-1">
                    System Settings
                </h4>

                <p class="text-muted mb-0">
                    Manage company and CRM settings
                </p>
            </div>
        </div>

        {{-- Success Message --}}
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show">

                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"></button>

            </div>

        @endif

        {{-- Validation Errors --}}
        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('settings.update') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="row">

                {{-- LEFT SIDE --}}
                <div class="col-lg-8">

                    {{-- Company Information --}}
                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-header bg-white">

                            <h5 class="mb-0">
                                Company Information
                            </h5>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label class="form-label fw-semibold">
                                        Company Name
                                    </label>

                                    <input type="text"
                                           name="company_name"
                                           class="form-control"
                                           value="{{ old('company_name', $setting->company_name ?? '') }}"
                                           placeholder="Enter company name">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label fw-semibold">
                                        Company Email
                                    </label>

                                    <input type="email"
                                           name="company_email"
                                           class="form-control"
                                           value="{{ old('company_email', $setting->company_email ?? '') }}"
                                           placeholder="company@example.com">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label fw-semibold">
                                        Company Phone
                                    </label>

                                    <input type="text"
                                           name="company_phone"
                                           class="form-control"
                                           value="{{ old('company_phone', $setting->company_phone ?? '') }}"
                                           placeholder="+91 XXXXX XXXXX">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label fw-semibold">
                                        Website
                                    </label>

                                    <input type="text"
                                           name="website"
                                           class="form-control"
                                           value="{{ old('website', $setting->website ?? '') }}"
                                           placeholder="https://example.com">

                                </div>

                                <div class="col-md-12 mb-3">

                                    <label class="form-label fw-semibold">
                                        Company Address
                                    </label>

                                    <textarea name="company_address"
                                              rows="4"
                                              class="form-control"
                                              placeholder="Enter company address">{{ old('company_address', $setting->company_address ?? '') }}</textarea>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- Office Settings --}}
                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-header bg-white">

                            <h5 class="mb-0">
                                Office Settings
                            </h5>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-4 mb-3">

                                    <label class="form-label fw-semibold">
                                        Office Start Time
                                    </label>

                                    <input type="time"
                                           name="office_start_time"
                                           class="form-control"
                                           value="{{ old('office_start_time', $setting->office_start_time ?? '') }}">

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="form-label fw-semibold">
                                        Office End Time
                                    </label>

                                    <input type="time"
                                           name="office_end_time"
                                           class="form-control"
                                           value="{{ old('office_end_time', $setting->office_end_time ?? '') }}">

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="form-label fw-semibold">
                                        Late Mark Time
                                    </label>

                                    <input type="time"
                                           name="late_mark_time"
                                           class="form-control"
                                           value="{{ old('late_mark_time', $setting->late_mark_time ?? '') }}">

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- System Settings --}}
                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-header bg-white">

                            <h5 class="mb-0">
                                System Settings
                            </h5>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label class="form-label fw-semibold">
                                        Timezone
                                    </label>

                                    <select name="timezone"
                                            class="form-select">

                                        <option value="Asia/Kolkata"
                                            {{ ($setting->timezone ?? '') == 'Asia/Kolkata' ? 'selected' : '' }}>
                                            Asia/Kolkata
                                        </option>

                                        <option value="UTC"
                                            {{ ($setting->timezone ?? '') == 'UTC' ? 'selected' : '' }}>
                                            UTC
                                        </option>

                                    </select>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label fw-semibold">
                                        Currency
                                    </label>

                                    <select name="currency"
                                            class="form-select">

                                        <option value="INR"
                                            {{ ($setting->currency ?? '') == 'INR' ? 'selected' : '' }}>
                                            INR
                                        </option>

                                        <option value="USD"
                                            {{ ($setting->currency ?? '') == 'USD' ? 'selected' : '' }}>
                                            USD
                                        </option>

                                    </select>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label fw-semibold">
                                        Date Format
                                    </label>

                                    <select name="date_format"
                                            class="form-select">

                                        <option value="d-m-Y">
                                            d-m-Y
                                        </option>

                                        <option value="Y-m-d">
                                            Y-m-d
                                        </option>

                                        <option value="d/m/Y">
                                            d/m/Y
                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- RIGHT SIDE --}}
                <div class="col-lg-4">

                    {{-- Logo --}}
                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-header bg-white">

                            <h5 class="mb-0">
                                Company Logo
                            </h5>

                        </div>

                        <div class="card-body text-center">

                            @if(!empty($setting->company_logo))

                                <img src="{{ asset('uploads/logo/'.$setting->company_logo) }}"
                                     class="img-fluid rounded shadow-sm mb-3"
                                     style="max-height: 120px;">

                            @else

                                <div class="border rounded p-5 text-muted mb-3">

                                    No Logo Uploaded

                                </div>

                            @endif

                            <input type="file"
                                   name="company_logo"
                                   class="form-control">

                        </div>

                    </div>

                    {{-- Save Button --}}
                    <div class="card border-0 shadow-sm">

                        <div class="card-body">

                            <button type="submit"
                                    class="btn btn-dark w-100">

                                <i class="fas fa-save me-1"></i>

                                Update Settings

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>

@endsection
