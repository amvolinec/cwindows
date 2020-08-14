@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create') }} {{ __('State') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if(isset($state))
                    <form action="{{ route('state.update', $state->id) }}" method="post">
                        @method('put')
                        @else
                        <form action="{{ route('state.store') }}" method="post">
                            @method('post')
                            @endif
                            @csrf

                                                        <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $state->name ?? old('name') }}" autocomplete="name" >

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="class" class="col-md-4 col-form-label text-md-right">{{ __('Class') }}</label>

                                <div class="col-md-6">
                                    <input id="class" type="text" class="form-control @error('class') is-invalid @enderror" name="class" value="{{ $state->class ?? old('class') }}" autocomplete="class" >

                                    @error('class')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="color" class="col-md-4 col-form-label text-md-right">{{ __('Color') }}</label>

                                <div class="col-md-6">
                                    <input id="color" type="text" class="form-control @error('color') is-invalid @enderror" name="color" value="{{ $state->color ?? old('color') }}" autocomplete="color" >

                                    @error('color')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-4"></div>
                                <div class="col-md-6">
                                    @if(isset($state))
                                    <button class="btn btn-success" type="submit">{{ __('Update') }}</button>
                                    @else
                                    <button class="btn btn-success" type="submit">{{ __('Save') }}</button>
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
