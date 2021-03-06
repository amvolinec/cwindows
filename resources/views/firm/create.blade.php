@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('Create Firm')}}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(isset($firm))
                            <form action="{{ route('firm.update', $firm->id) }}" method="post">
                                @method('put')
                                @else
                                    <form action="{{ route('firm.store') }}" method="post">
                                        @method('post')
                                        @endif
                                        @csrf

                                        <div class="form-group row">
                                            <label for="code"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Code') }}</label>
                                            <div class="col-md-6">
                                                <input id="code" type="text"
                                                       class="form-control" id="exampleInputEmail1" a
                                                       placeholder="Enter code"
                                                       class="form-control @error('code') is-invalid @enderror"
                                                       name="code" value="{{ $firm->code ?? old('code') }}"
                                                       autocomplete="code">

                                                @error('code')
                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="vat_code"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Vat code') }}</label>
                                            <div class="col-md-6">
                                                <input id="vat_code" type="text"
                                                       class="form-control" id="exampleInputEmail1" a
                                                       placeholder="Enter VAT code"
                                                       class="form-control @error('vat_code') is-invalid @enderror"
                                                       name="vat_code" value="{{ $firm->name ?? old('vat_code') }}"
                                                       autocomplete="vat_code">

                                                @error('vat_code')
                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="name"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Company name') }}</label>
                                            <div class="col-md-6">
                                                <input id="name" type="text"
                                                       class="form-control" id="exampleInputEmail1" a
                                                       placeholder="Enter company name"
                                                       class="form-control @error('name') is-invalid @enderror"
                                                       name="name" value="{{ $firm->name ?? old('name') }}"
                                                       autocomplete="name">

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="account"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Bank account') }}</label>

                                            <div class="col-md-6">
                                                <input id="account" type="text"
                                                       class="form-control" id="exampleInputEmail1" a
                                                       placeholder="Enter bank account"
                                                       class="form-control @error('address') is-invalid @enderror"
                                                       name="account" value="{{ $firm->account ?? old('account') }}"
                                                       autocomplete="account">

                                                @error('account')
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
                                                       class="form-control" id="exampleInputEmail1" a
                                                       placeholder="Enter phone number"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       name="phone" value="{{ $firm->email ?? old('phone') }}"
                                                       autocomplete="phone">

                                                @error('phone')
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
                                                       class="form-control" id="exampleInputEmail1" a
                                                       placeholder="Enter address"
                                                       class="form-control @error('address') is-invalid @enderror"
                                                       name="address" value="{{ $firm->address ?? old('address') }}"
                                                       autocomplete="address">

                                                @error('address')
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
                                                       class="form-control" id="exampleInputEmail1" a
                                                       placeholder="Enter email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       name="email" value="{{ $firm->comment ?? old('email') }}"
                                                       autocomplete="email">

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="city"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                                            <div class="col-md-6">
                                                <input id="city" type="text"
                                                       class="form-control" id="exampleInputEmail1" a
                                                       placeholder="Enter city"
                                                       class="form-control @error('city') is-invalid @enderror"
                                                       name="city" value="{{ $firm->city ?? old('city') }}"
                                                       autocomplete="city">

                                                @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="comment"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Comment') }}</label>

                                            <div class="col-md-6">
                                                <input id="comment" type="text"
                                                       class="form-control" id="exampleInputEmail1" a
                                                       placeholder="Please, write a comment"
                                                       class="form-control @error('comment') is-invalid @enderror"
                                                       name="comment" value="{{ $firm->comment ?? old('comment') }}"
                                                       autocomplete="comment">

                                                @error('comment')
                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-6">
                                                @if(isset($firm))
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




