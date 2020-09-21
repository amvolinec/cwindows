@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Create') }} {{ __('Offer') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(isset($offer))
                        <form action="{{ route('offer.update', $offer->id) }}" method="post">
                            @method('put')
                        @else
                         <form action="{{ route('offer.store') }}" method="post">
                            @method('post')
                        @endif
                            @csrf

                            <div class="form-group row">
                                <label for="client_id" class="col-md-4 col-form-label text-md-right">{{ __('Client Id') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="client_id" id="client_id" >
                                        <option value="" disabled selected>{{ __('Select your option') }}</option>
                                        @foreach($clients as $item)
                                            <option value="{{ $item->id }}"
                                                    @if(isset($offer) && $item->id === $offer->client_id) selected @endif>{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="architect_id" class="col-md-4 col-form-label text-md-right">{{ __('Architect Id') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="architect_id" id="architect_id" >
                                        <option value="" disabled selected>{{ __('Select your option') }}</option>
                                        @foreach($architects as $item)
                                            <option value="{{ $item->id }}"
                                                    @if(isset($offer) && $item->id === $offer->architect_id) selected @endif>{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="enquiry_date" class="col-md-4 col-form-label text-md-right">{{ __('Enquiry Date') }}</label>

                                <div class="col-md-6">
                                    <input id="enquiry_date" type="date" class="form-control @error('enquiry_date') is-invalid @enderror" name="enquiry_date" value="{{ $offer->enquiry_date ??  old('enquiry_date') }}" autocomplete="enquiry_date" >

                                    @error('enquiry_date')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pv" class="col-md-4 col-form-label text-md-right">{{ __('Pv') }}</label>

                                <div class="col-md-6">
                                    <input id="pv" type="text" class="form-control @error('pv') is-invalid @enderror" name="pv" value="{{ $offer->pv ?? old('pv') }}" autocomplete="pv" >

                                    @error('pv')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="profile" class="col-md-4 col-form-label text-md-right">{{ __('Profile') }}</label>

                                <div class="col-md-6">
                                    <input id="profile" type="text" class="form-control @error('profile') is-invalid @enderror" name="profile" value="{{ $offer->profile ?? old('profile') }}" autocomplete="profile" >

                                    @error('profile')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                                <div class="form-group row">
                                <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="state" id="state" >
                                        <option value="" disabled selected>{{ __('Select your option') }}</option>
                                            <option value="Inquiry" @if(isset($offer) && 'Inquiry' === $offer->state) selected @endif>Inquiry</option>
                                            <option value="Proposal" @if(isset($offer) && 'Proposal' === $offer->state) selected @endif>Proposal</option>
                                            <option value="Order" @if(isset($offer) && 'Order' === $offer->state) selected @endif>Order</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="info" class="col-md-4 col-form-label text-md-right">{{ __('Info') }}</label>

                                <div class="col-md-6">
                                    <input id="info" type="text" class="form-control @error('info') is-invalid @enderror" name="info" value="{{ $offer->info ?? old('info') }}" autocomplete="info" >

                                    @error('info')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="enquiry_channel" class="col-md-4 col-form-label text-md-right">{{ __('Enquiry Channel') }}</label>

                                <div class="col-md-6">
                                    <input id="enquiry_channel" type="text" class="form-control @error('enquiry_channel') is-invalid @enderror" name="enquiry_channel" value="{{ $offer->enquiry_channel ?? old('enquiry_channel') }}" autocomplete="enquiry_channel" >

                                    @error('enquiry_channel')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="klaes" class="col-md-4 col-form-label text-md-right">{{ __('KLAES Nr.') }}</label>

                                <div class="col-md-6">
                                    <input id="klaes" type="text" class="form-control @error('klaes') is-invalid @enderror" name="klaes" value="{{ $offer->klaes ?? old('klaes') }}" autocomplete="klaes" >

                                    @error('klaes')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="contract_date" class="col-md-4 col-form-label text-md-right">{{ __('Contract Date') }}</label>

                                <div class="col-md-6">
                                    <input id="contract_date" type="date" class="form-control @error('contract_date') is-invalid @enderror" name="contract_date" value="{{ $offer->contract_date ??  old('contract_date') }}" autocomplete="contract_date" >

                                    @error('contract_date')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="contract_nr" class="col-md-4 col-form-label text-md-right">{{ __('Contract Nr.') }}</label>

                                <div class="col-md-6">
                                    <input id="contract_nr" type="text" class="form-control @error('contract_nr') is-invalid @enderror" name="contract_nr" value="{{ $offer->contract_nr ?? old('contract_nr') }}" autocomplete="contract_nr" >

                                    @error('contract_nr')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="total" class="col-md-4 col-form-label text-md-right">{{ __('Total') }}</label>

                                <div class="col-md-6">
                                    <input id="total" type="number" step=".01" class="form-control @error('total') is-invalid @enderror" name="total" value="{{ $offer->total ?? old('total') }}" autocomplete="total" >

                                    @error('total')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="total_with_vat" class="col-md-4 col-form-label text-md-right">{{ __('Total With VAT') }}</label>

                                <div class="col-md-6">
                                    <input id="total_with_vat" type="number" step=".01" class="form-control @error('total_with_vat') is-invalid @enderror" name="total_with_vat" value="{{ $offer->total_with_vat ?? old('total_with_vat') }}" autocomplete="total_with_vat" >

                                    @error('total_with_vat')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="balance" class="col-md-4 col-form-label text-md-right">{{ __('Balance') }}</label>

                                <div class="col-md-6">
                                    <input id="balance" type="number" step=".01" class="form-control @error('balance') is-invalid @enderror" name="balance" value="{{ $offer->balance ?? old('balance') }}" autocomplete="balance" >

                                    @error('balance')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="expenses" class="col-md-4 col-form-label text-md-right">{{ __('Other Services') }}</label>

                                <div class="col-md-6">
                                    <input id="expenses" type="text" class="form-control @error('expenses') is-invalid @enderror" name="expenses" value="{{ $offer->expenses ?? old('expenses') }}" autocomplete="expenses" >

                                    @error('expenses')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sales_profit" class="col-md-4 col-form-label text-md-right">{{ __('Sales Profit') }}</label>

                                <div class="col-md-6">
                                    <input id="sales_profit" type="number" step=".01" class="form-control @error('sales_profit') is-invalid @enderror" name="sales_profit" value="{{ $offer->sales_profit ?? old('sales_profit') }}" autocomplete="sales_profit" >

                                    @error('sales_profit')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="project_amount" class="col-md-4 col-form-label text-md-right">{{ __('Project Amount') }}</label>

                                <div class="col-md-6">
                                    <input id="project_amount" type="number" step=".01" class="form-control @error('project_amount') is-invalid @enderror" name="project_amount" value="{{ $offer->project_amount ?? old('project_amount') }}" autocomplete="project_amount" >

                                    @error('project_amount')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="project_amount_with_vat" class="col-md-4 col-form-label text-md-right">{{ __('Project Amount With VAT') }}</label>

                                <div class="col-md-6">
                                    <input id="project_amount_with_vat" type="number" step=".01" class="form-control @error('project_amount_with_vat') is-invalid @enderror" name="project_amount_with_vat" value="{{ $offer->project_amount_with_vat ?? old('project_amount_with_vat') }}" autocomplete="project_amount_with_vat" >

                                    @error('project_amount_with_vat')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>

                            @if(isset($offer))
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
