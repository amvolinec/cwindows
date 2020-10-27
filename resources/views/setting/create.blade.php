@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create') }} {{ __('Setting') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                        @if($errors->any())
                            <div class="alert alert-warning" role="alert">
                                <h4>{{$errors->first()}}</h4>
                            </div>
                        @endif

                    <form action="{{ isset($setting) ? route('setting.update', $setting->id) : route('setting.store') }}" method="post" enctype="multipart/form-data">
                        @method( isset($setting) ? 'put' : 'post')
                        @csrf

                                                    <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $setting->name ?? old('name') }}" autocomplete="name" >

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Code') }}</label>

                                <div class="col-md-6">
                                    <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ $setting->code ?? old('code') }}" autocomplete="code" >

                                    @error('code')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="vat_code" class="col-md-4 col-form-label text-md-right">{{ __('Vat Code') }}</label>

                                <div class="col-md-6">
                                    <input id="vat_code" type="text" class="form-control @error('vat_code') is-invalid @enderror" name="vat_code" value="{{ $setting->vat_code ?? old('vat_code') }}" autocomplete="vat_code" >

                                    @error('vat_code')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $setting->address ?? old('address') }}" autocomplete="address" >

                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $setting->phone ?? old('phone') }}" autocomplete="phone" >

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="account" class="col-md-4 col-form-label text-md-right">{{ __('Account') }}</label>

                                <div class="col-md-6">
                                    <input id="account" type="text" class="form-control @error('account') is-invalid @enderror" name="account" value="{{ $setting->account ?? old('account') }}" autocomplete="account" >

                                    @error('account')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $setting->email ?? old('email') }}" autocomplete="email" >

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="web" class="col-md-4 col-form-label text-md-right">{{ __('Web') }}</label>

                                <div class="col-md-6">
                                    <input id="web" type="text" class="form-control @error('web') is-invalid @enderror" name="web" value="{{ $setting->web ?? old('web') }}" autocomplete="web" >

                                    @error('web')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4"></div>
                                <div class="input-group col-md-6">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"
                                               id="fileUpload" value="{{ $setting->file_uri ?? old('file_uri') }}"
                                               aria-describedby="inputGroupFileAddon01" name="file_uri" >
                                        <label class="custom-file-label" for="fileUpload">{{ __('Logo') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="currency_id" class="col-md-4 col-form-label text-md-right">{{ __('Currency') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="currency_id" id="currency_id" >
                                        <option value="" disabled selected>{{ __('Select your option') }}</option>
                                        @foreach($currencies as $item)
                                            <option value="{{ $item->id }}"
                                                    @if(isset($setting) && $item->id === $setting->currency_id) selected @endif>{{ $item->currency }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                        <div class="form-group row mt-3">
                            <div class="col-md-4"></div>
                            <div class="col-md-6">
                                @if(isset($setting))
                                <button class="btn btn-outline-success" type="submit">
                                    <i class="far fa-save"></i> {{ __('Update') }}</button>
                                @else
                                <button class="btn btn-outline-success" type="submit">
                                    <i class="far fa-save"></i> {{ __('Save') }}</button>
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

@section('scripts')
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });
</script>
@endsection
