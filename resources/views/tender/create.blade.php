@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create') }} {{ __('Tender') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="{{ isset($tender) ? route('tender.update', $tender->id) : route('tender.store') }}" method="post">
                        @method( isset($tender) ? 'put' : 'post')
                        @csrf

                                                    <div class="form-group row">
                                <label for="manager_id" class="col-md-4 col-form-label text-md-right">{{ __('Manager') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="manager_id" id="manager_id" >
                                        <option value="" disabled selected>{{ __('Select your option') }}</option>
                                        @foreach($managers as $item)
                                            <option value="{{ $item->id }}"
                                                    @if(isset($tender) && $item->id === $tender->manager_id) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="delivery_address" class="col-md-4 col-form-label text-md-right">{{ __('Delivery Address') }}</label>

                                <div class="col-md-6">
                                    <input id="delivery_address" type="text" class="form-control @error('delivery_address') is-invalid @enderror" name="delivery_address" value="{{ $tender->delivery_address ?? old('delivery_address') }}" autocomplete="delivery_address" >

                                    @error('delivery_address')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="version" class="col-md-4 col-form-label text-md-right">{{ __('Version') }}</label>

                                <div class="col-md-6">
                                    <input id="version" type="number" class="form-control @error('version') is-invalid @enderror" name="version" value="{{ $tender->version ?? old('version') }}" autocomplete="version" >

                                    @error('version')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="profile_id" class="col-md-4 col-form-label text-md-right">{{ __('Profile') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="profile_id" id="profile_id" >
                                        <option value="" disabled selected>{{ __('Select your option') }}</option>
                                        @foreach($profiles as $item)
                                            <option value="{{ $item->id }}"
                                                    @if(isset($tender) && $item->id === $tender->profile_id) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="materials" class="col-md-4 col-form-label text-md-right">{{ __('Materials') }}</label>

                                <div class="col-md-6">
                                    <input id="materials" type="text" class="form-control @error('materials') is-invalid @enderror" name="materials" value="{{ $tender->materials ?? old('materials') }}" autocomplete="materials" >

                                    @error('materials')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="colors" class="col-md-4 col-form-label text-md-right">{{ __('Colors') }}</label>

                                <div class="col-md-6">
                                    <input id="colors" type="text" class="form-control @error('colors') is-invalid @enderror" name="colors" value="{{ $tender->colors ?? old('colors') }}" autocomplete="colors" >

                                    @error('colors')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="squaring" class="col-md-4 col-form-label text-md-right">{{ __('Squaring') }}</label>

                                <div class="col-md-6">
                                    <input id="squaring" type="text" class="form-control @error('squaring') is-invalid @enderror" name="squaring" value="{{ $tender->squaring ?? old('squaring') }}" autocomplete="squaring" >

                                    @error('squaring')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="meters" class="col-md-4 col-form-label text-md-right">{{ __('Meters') }}</label>

                                <div class="col-md-6">
                                    <input id="meters" type="number" step=".01" class="form-control @error('meters') is-invalid @enderror" name="meters" value="{{ $tender->meters ?? old('meters') }}" autocomplete="meters" >

                                    @error('meters')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="total_with_vat" class="col-md-4 col-form-label text-md-right">{{ __('Total With VAT') }}</label>

                                <div class="col-md-6">
                                    <input id="total_with_vat" type="number" step=".01" class="form-control @error('total_with_vat') is-invalid @enderror" name="total_with_vat" value="{{ $tender->total_with_vat ?? old('total_with_vat') }}" autocomplete="total_with_vat" >

                                    @error('total_with_vat')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cost" class="col-md-4 col-form-label text-md-right">{{ __('Cost') }}</label>

                                <div class="col-md-6">
                                    <input id="cost" type="number" step=".01" class="form-control @error('cost') is-invalid @enderror" name="cost" value="{{ $tender->cost ?? old('cost') }}" autocomplete="cost" >

                                    @error('cost')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="expenses" class="col-md-4 col-form-label text-md-right">{{ __('Expenses') }}</label>

                                <div class="col-md-6">
                                    <input id="expenses" type="number" step=".01" class="form-control @error('expenses') is-invalid @enderror" name="expenses" value="{{ $tender->expenses ?? old('expenses') }}" autocomplete="expenses" >

                                    @error('expenses')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="comments" class="col-md-4 col-form-label text-md-right">{{ __('Comments') }}</label>

                                <div class="col-md-6">
                                    <textarea id="comments" type="text" class="form-control @error('comments') is-invalid @enderror" name="comments" autocomplete="comments" >{{ $tender->comments ?? old('comments') }}</textarea>

                                    @error('comments')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>

                                <div class="col-md-6">
                                    <input id="state" type="number" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ $tender->state ?? old('state') }}" autocomplete="state" >

                                    @error('state')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="offer_id" class="col-md-4 col-form-label text-md-right">{{ __('Offer') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="offer_id" id="offer_id" >
                                        <option value="" disabled selected>{{ __('Select your option') }}</option>
                                        @foreach($offers as $item)
                                            <option value="{{ $item->id }}"
                                                    @if(isset($tender) && $item->id === $tender->offer_id) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="total" class="col-md-4 col-form-label text-md-right">{{ __('Total') }}</label>

                                <div class="col-md-6">
                                    <input id="total" type="number" step=".01" class="form-control @error('total') is-invalid @enderror" name="total" value="{{ $tender->total ?? old('total') }}" autocomplete="total" >

                                    @error('total')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>


                        <div class="form-group row mt-3">
                            <div class="col-md-4"></div>
                            <div class="col-md-6">
                                @if(isset($tender))
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
