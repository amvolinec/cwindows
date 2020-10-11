@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Create') }} {{ __('User') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ isset($user) ? route('user.update', $user->id) : route('user.store') }}"
                              method="post">
                            @method( isset($user) ? 'put' : 'post')
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" required
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ $user->name ?? old('name') }}" autocomplete="name">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" required
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ $user->email ?? old('email') }}" autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            @if(isset($user))
                                <div class="row mt-4">
                                    <div class="col-md-4"></div>
                                    <h6 class="col-md-6">If you want to change password:</h6>
                                </div>
                            @endif

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="role"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Assign Role') }}</label>

                                <div class="col-md-6">
                                    <select name="roles[]" id="roles" multiple="multiple"  class="form-control select_multiple">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}" {{ isset($user) && $user->hasRole($role->name) ? 'selected="selected"' : ''}}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @if($current_user->hasRole('super-admin'))
                                <div class="form-group row">
                                    <label for="setting_id"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Company') }}</label>

                                    <div class="col-md-6">
                                        <select class="form-control" name="setting_id" id="setting_id">
                                            <option value="" disabled selected>{{ __('Select your option') }}</option>
                                            @foreach($settings as $item)
                                                <option value="{{ $item->id }}"
                                                        @if(isset($user) && $item->id === $user->setting_id) selected @endif>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @else
                                <input type="hidden" name="setting_id" value="{{ $current_user->setting_id }}">
                            @endif

                            <div class="form-group row mt-3">
                                <div class="col-md-4"></div>
                                <div class="col-md-6">
                                    @if(isset($user))
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
            $('#roles').select2({multiple: true});
            $('#setting_id').select2();
        });
    </script>
@endsection
