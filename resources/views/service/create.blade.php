@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Create') }} {{ __('Service') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if($errors->all())
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-6 alert alert-warning" role="alert">
                                    <ul>
                                        @foreach($errors->all() as $message)
                                            <li> {{$message}} </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <form
                            action="{{ isset($service) ? route('service.update', $service->id) : route('service.store') }}"
                            method="post">
                            @method( isset($service) ? 'put' : 'post')
                            @csrf

                            <div class="form-group row">
                                <label for="completed_at"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Completion date') }}</label>

                                <div class="col-md-6">
                                    <datetime id="completed_at" type="date" name="completed_at"
                                              value="{{ $service->completed_at ??  old('completed_at') }}"
                                              input-class="form-control" format="yyyy-MM-dd"
                                              value-zone="UTC+3"></datetime>
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
                                                    @if(isset($service) && $item['id'] === $service->state_id || (int)old('state_id') === $item['id']) selected @endif>
                                                {{ $item['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="costs"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Costs') }}</label>

                                <div class="col-md-6">
                                    <input id="costs" type="number"
                                           class="form-control @error('costs') is-invalid @enderror" name="costs"
                                           value="{{ $service->costs ?? old('costs') }}" autocomplete="costs">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="income"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Income') }}</label>

                                <div class="col-md-6">
                                    <input id="income" type="number"
                                           class="form-control @error('income') is-invalid @enderror" name="income"
                                           value="{{ $service->income ?? old('income') }}" autocomplete="income">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="payer_id"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Who Pays') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="payer_id" id="payer_id">
                                        <option value="" disabled selected>{{ __('Select your option') }}</option>
                                        @foreach($payers as $item)
                                            <option value="{{ $item['id'] }}"
                                                    @if(isset($service) && $item['id'] === $service->payer_id || $item['id'] === (int)old('payer_id') || $item['id'] === 1) selected @endif>
                                                {{ $item['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4"></div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input id="warrantyCheck" type="checkbox" class="form-check-input"
                                               name="warranty"
                                               @if(isset($service) && $service->warranty && $service->warranty === 1) checked @endif>
                                        <label class="form-check-label" for="warrantyCheck">{{ __('Warranty') }}</label>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="notes"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Notes') }}</label>

                                <div class="col-md-6">
                                    <textarea id="notes" type="text"
                                              class="form-control @error('notes') is-invalid @enderror" name="notes"
                                              autocomplete="notes">{{ $service->notes ?? old('notes') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="list_of_orders"
                                       class="col-md-4 col-form-label text-md-right">{{ __('List Of Orders') }}</label>

                                <div class="col-md-6">
                                    <textarea id="list_of_orders" type="text"
                                              class="form-control @error('list_of_orders') is-invalid @enderror"
                                              name="list_of_orders"
                                              autocomplete="list_of_orders">{{ $service->list_of_orders ?? old('list_of_orders') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="executor"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Executor') }}</label>

                                <div class="col-md-6">
                                    <input id="executor" type="text"
                                           class="form-control @error('executor') is-invalid @enderror" name="executor"
                                           value="{{ $service->executor ?? old('executor') }}" autocomplete="executor">
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
                                                    @if(isset($service) && $item->id === $service->offer_id || $item['id'] === (int)old('offer_id')) selected @endif>
                                                {{ $item->inquiry_date}}-{{ $item->id }} {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="manager_id"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Manager') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="manager_id" id="manager_id">
                                        <option value="" disabled selected>{{ __('Select your option') }}</option>
                                        @foreach($managers as $item)
                                            <option value="{{ $item->id }}"
                                                    @if(isset($service) && $item->id === $service->manager_id) selected @endif>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <div class="col-md-4"></div>
                                <div class="col-md-6">
                                    @if(isset($service))
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
            $('#state_id').select2();
            $('#payer_id').select2();
            $('#manager_id').select2();
            $('#offer_id').select2();
        });
    </script>
@endsection
