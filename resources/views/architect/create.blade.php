@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Create') }} {{ __('Architect') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(isset($architect))
                        <form action="{{ route('architect.update', $architect->id) }}" method="post">
                            @method('put')
                        @else
                         <form action="{{ route('architect.store') }}" method="post">
                            @method('post')
                        @endif
                            @csrf

                                                        <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $architect->title ?? old('title') }}" autocomplete="title" >

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $architect->phone ?? old('phone') }}" autocomplete="phone" >

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $architect->email ?? old('email') }}" autocomplete="email" >

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="company" class="col-md-4 col-form-label text-md-right">{{ __('Company') }}</label>

                                <div class="col-md-6">
                                    <input id="company" type="text" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ $architect->company ?? old('company') }}" autocomplete="company" >

                                    @error('company')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>

                            @if(isset($architect))
                            <button class="btn btn-success" type="submit">{{ __('Update') }}</button>
                            @else
                            <button class="btn btn-success" type="submit">{{ __('Save') }}</button>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
