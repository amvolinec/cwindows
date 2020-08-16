@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create') }} {{ __('Category') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if(isset($category))
                    <form action="{{ route('category.update', $category->id) }}" method="post">
                        @method('put')
                        @else
                        <form action="{{ route('category.store') }}" method="post">
                            @method('post')
                            @endif
                            @csrf

                                                        <div class="form-group row">
                                <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Code') }}</label>

                                <div class="col-md-6">
                                    <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ $category->code ?? old('code') }}" autocomplete="code" >

                                    @error('code')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $category->name ?? old('name') }}" autocomplete="name" >

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-4"></div>
                                <div class="col-md-6">
                                    @if(isset($category))
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
