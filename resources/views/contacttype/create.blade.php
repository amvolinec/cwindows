@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('Create Contact Type')}}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(isset($contactType))
                            <form action="{{ route('contact_type.update', $contactType->id) }}" method="post">
                                @method('put')
                                @else
                                    <form action="{{ route('contact_type.store') }}" method="post">
                                        @method('post')
                                        @endif
                                        @csrf

                                        <div class="form-group row">
                                            <label for="name"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                            <div class="col-md-6">
                                                <input id="name" type="text"
                                                       placeholder="Enter name"
                                                       class="form-control @error('name') is-invalid @enderror"
                                                       name="name" value="{{ $contactType->name ?? old('name') }}"
                                                       autocomplete="name">

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="title"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                            <div class="col-md-6">
                                                <input id="title" type="text"
                                                       placeholder="Enter title"
                                                       class="form-control @error('title') is-invalid @enderror"
                                                       name="title" value="{{ $contactType->title ?? old('title') }}"
                                                       autocomplete="title">

                                                @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                            <div class="col-md-6">
                                                <input id="description" type="text" class="form-control"
                                                       placeholder="Enter description"
                                                       class="form-control @error('description') is-invalid @enderror"
                                                       name="description"
                                                       value="{{ $contactType->description ?? old('description') }}"
                                                       autocomplete="description">

                                                @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-6">
                                                @if(isset($contactType))
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
@endsection

{{--@section('scripts')--}}
{{--    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#firm_id').select2();--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}


