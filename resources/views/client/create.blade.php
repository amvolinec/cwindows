@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Create') }} {{ __('Client') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(isset($client))
                            <form action="{{ route('client.update', $client->id) }}" method="post">
                                @method('put')
                                @else
                                    <form action="{{ route('client.store') }}" method="post">
                                        @method('post')
                                        @endif
                                        @csrf

                                        <div class="form-group row">
                                            <label for="name"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text"
                                                       class="form-control @error('name') is-invalid @enderror"
                                                       name="name" value="{{ $client->name ?? old('name') }}"
                                                       autocomplete="name">

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="contact"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Contact') }}</label>

                                            <div class="col-md-6">
                                                <input id="contact" type="text"
                                                       class="form-control @error('contact') is-invalid @enderror"
                                                       name="contact" value="{{ $client->contact ?? old('contact') }}"
                                                       autocomplete="contact">

                                                @error('contact')
                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="company_id"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Company') }}</label>

                                            <div class="col-md-6">
                                                <select class="form-control select2" name="company_id" id="company_id">
                                                    <option value="" disabled
                                                            selected>{{ __('Select your option') }}</option>
                                                    @foreach($companies as $item)
                                                        <option value="{{ $item->id }}"
                                                                @if(isset($client) && $item->id === $client->company_id) selected @endif>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="phone"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                            <div class="col-md-6">
                                                <input id="phone" type="text"
                                                       class="form-control @error('phone') is-invalid @enderror"
                                                       name="phone" value="{{ $client->phone ?? old('phone') }}"
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
                                                   class="col-md-4 col-form-label text-md-right">{{ __('E-mail') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="text"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       name="email" value="{{ $client->email ?? old('email') }}"
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
                                                       class="form-control @error('city') is-invalid @enderror"
                                                       name="city" value="{{ $client->city ?? old('city') }}"
                                                       autocomplete="city">

                                                @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-6">
                                                @if(isset($client))
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
