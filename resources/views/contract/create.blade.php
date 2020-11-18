
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('Create Contract')}}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('contract.store') }}" method="post">
                            @method('post')
                            @csrf

                            <div class="form-group">
                                <lable>{{__('Signed_at')}}</lable>
                                <input class="form-control @error('name') is-invalid @enderror" type="date" name="name"
                                       value="{{ old('signed_at')}}">

                                <lable>{{__('Planed_at')}}</lable>
                                <input class="form-control @error('name') is-invalid @enderror" type="date" name="name"
                                       value="{{ old('planed_at')}}">

                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button class="btn btn-success" type="submit">{{ __('Save') }}</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
