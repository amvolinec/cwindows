@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Create') }} {{ __('Transaction') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form
                            action="{{ isset($transaction) ? route('transaction.update', $transaction->id) : route('transaction.store') }}"
                            method="post">
                            @method( isset($transaction) ? 'put' : 'post')
                            @csrf

                            <div class="form-group row">
                                <label for="amount"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                                <div class="col-md-6">
                                    <input id="amount" type="number"
                                           class="form-control @error('amount') is-invalid @enderror" name="amount"
                                           value="{{ $transaction->amount ?? old('amount') }}" autocomplete="amount">

                                    @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="number"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Number') }}</label>

                                <div class="col-md-6">
                                    <input id="number" type="text"
                                           class="form-control @error('number') is-invalid @enderror" name="number"
                                           value="{{ $transaction->number ?? old('number') }}" autocomplete="number">

                                    @error('number')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="state_id"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>
                                <div class="col-md-6">
                                <datetime id="date" type="date" name="date"
                                          value="{{ $service->date ??  old('date') }}" input-class="form-control"
                                          format="yyyy-MM-dd" value-zone="UTC+3"></datetime>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="state_id"
                                       class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="state_id" id="state_id">
                                        <option value="" disabled selected>{{ __('Select your option') }}</option>
                                        @foreach($states as $item)
                                            <option value="{{ $item['id'] }}"
                                                    @if(isset($transaction) && $item['id'] === $transaction->state_id) selected @endif>{{ $item['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="transaction_type_id"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Transaction Type') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="transaction_type_id" id="transaction_type_id">
                                        <option value="" disabled selected>{{ __('Select your option') }}</option>
                                        @foreach($transaction_types as $item)
                                            <option value="{{ $item->id }}"
                                                    @if(isset($transaction) && $item->id === $transaction->transaction_type_id) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="info" class="col-md-4 col-form-label text-md-right">{{ __('Info') }}</label>

                                <div class="col-md-6">
                                    <textarea id="info" type="text"
                                              class="form-control @error('info') is-invalid @enderror" name="info"
                                              autocomplete="info">{{ $transaction->info ?? old('info') }}</textarea>

                                    @error('info')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="details"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Details') }}</label>

                                <div class="col-md-6">
                                    <textarea id="details" type="text"
                                              class="form-control @error('details') is-invalid @enderror" name="details"
                                              autocomplete="details">{{ $transaction->details ?? old('details') }}</textarea>

                                    @error('details')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="offer_id"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Offer') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="offer_id" id="offer_id">
                                        <option value="" disabled selected>{{ __('Select your option') }}</option>
                                        @foreach($offers as $item)
                                            <option value="{{ $item->id }}"
                                                    @if(isset($transaction) && $item->id === $transaction->offer_id) selected @endif>{{ $item->id }}
                                                -{{ $item->inquiry_date }}{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row mt-3">
                                <div class="col-md-4"></div>
                                <div class="col-md-6">
                                    @if(isset($transaction))
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
