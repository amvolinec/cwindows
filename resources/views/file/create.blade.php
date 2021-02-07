@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create') }} {{ __('File') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="{{ isset($file) ? route('file.update', $file->id) : route('file.store') }}" method="post" enctype="multipart/form-data">
                        @method( isset($file) ? 'put' : 'post')
                        @csrf

                                                    <div class="form-group row">
                                <label for="file_name" class="col-md-4 col-form-label text-md-right">{{ __('File Name') }}</label>

                                <div class="col-md-6">
                                    <input id="file_name" type="text"
                                           class="form-control @error('file_name') is-invalid @enderror" name="file_name" value="{{ $file->file_name ?? old('file_name') }}" autocomplete="file_name" >

                                    @error('file_name')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="file_uri" class="col-md-4 col-form-label text-md-right">{{ __('File Path') }}</label>

                                <div class="col-md-6">
                                    <input id="file_uri" type="text" class="form-control @error('file_uri') is-invalid @enderror" name="file_uri" value="{{ $file->file_uri ?? old('file_uri') }}" autocomplete="file_uri" >

                                    @error('file_uri')
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
                                        @foreach($offer as $item)
                                            <option value="{{ $item->id }}"
                                                    @if(isset($file) && $item->id === $file->offer_id) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                        <div class="form-group row mt-3">
                            <div class="col-md-4"></div>
                            <div class="col-md-6">
                                @if(isset($file))
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
