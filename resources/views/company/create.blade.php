@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Create') }} {{ __('Company') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(isset($company))
                            <form action="{{ route('company.update', $company->id) }}" method="post">
                                @method('put')
                                @else
                            <form action="{{ route('company.store') }}" method="post">
                                @method('post')
                                @endif

                                @csrf

                                <div class="form-group row">
                                    <label for="name"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="name" value="{{ $company->name ?? old('name') }}"
                                               autocomplete="name">

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                    <div class="col-md-6">
                                        <input id="phone" type="text"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               name="phone" value="{{ $company->phone ?? old('phone') }}"
                                               autocomplete="phone">

                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="text"
                                               class="form-control @error('email') is-invalid @enderror"
                                               name="email" value="{{ $company->email ?? old('email') }}"
                                               autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="address" type="text"
                                               class="form-control @error('address') is-invalid @enderror"
                                               name="address" value="{{ $company->address ?? old('address') }}"
                                               autocomplete="address">

                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="code"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Code') }}</label>

                                    <div class="col-md-6">
                                        <input id="code" type="text"
                                               class="form-control @error('code') is-invalid @enderror"
                                               name="code" value="{{ $company->code ?? old('code') }}"
                                               autocomplete="code">

                                        @error('code')
                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="account"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Account') }}</label>

                                    <div class="col-md-6">
                                        <input id="account" type="text"
                                               class="form-control @error('account') is-invalid @enderror"
                                               name="account" value="{{ $company->account ?? old('account') }}"
                                               autocomplete="account">

                                        @error('account')
                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="vat_code"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Vat Code') }}</label>

                                    <div class="col-md-6">
                                        <input id="vat_code" type="text"
                                               class="form-control @error('vat_code') is-invalid @enderror"
                                               name="vat_code"
                                               value="{{ $company->vat_code ?? old('vat_code') }}"
                                               autocomplete="vat_code">

                                        @error('vat_code')
                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-6">
                                        @if(isset($company))
                                            <button class="btn btn-success"
                                                    type="submit">{{ __('Update') }}</button>
                                        @else
                                            <button class="btn btn-success"
                                                    type="submit">{{ __('Save') }}</button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
