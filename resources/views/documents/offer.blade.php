@extends('layouts.doc')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <p>{{ $offer->client ? $offer->client->name : '' }}</p>

            </div>
            <div class="col-md-6">
                <p>Windows</p>
            </div>
            <div class="col-md-12">
                @foreach($positions as $item)
                    {{ $item->title}}
                @endforeach
            </div>
        </div>
    </div>
@endsection
