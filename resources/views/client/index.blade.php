@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-inline-block" style="vertical-align: top;">
                            <form action="{{ route('client.create') }}">
                                @method('post')
                                @csrf
                                <button class="btn btn-success">+</button>
                            </form>
                        </div>
                        <div class="d-inline-block" style="vertical-align: top; padding: 6px;">
                            <h4>{{ __('Clients') }}</h4>
                        </div>
                        <find route="client" fields="name,phone,email" search="{{ $search ?? '' }}"></find>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped">
                            <thead class="thead">
                            <tr>
                                <th scope="col">{{ __("Created") }}</th>
                                <th scope="col">{{ __("Name") }}</th>
                                <th scope="col">{{ __("Company") }}</th>
                                <th scope="col">{{ __("Phone") }}</th>
                                <th scope="col">{{ __("E-mail") }}</th>
                                <th scope="col">{{ __("City") }}</th>
                                <th scope="col">{{ __("Notes") }}</th>
                                <th scope="col">{{ __("Offers") }}</th>

                                <th scope="col">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients AS $client)
                                <tr>
                                    <td>{{ substr($client->created_at,0,10) }}</td>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->company->name ?? '' }}</td>
                                    <td>{{ $client->phone }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->city }}</td>
                                    <td>{{ $client->notes }}</td>
                                    <td>
                                        @if($client->offers)
                                            @foreach($client->offers as $offer)
                                                <a href="/offer/{{ $offer->id }}" target="_blank">
                                                    {{ $offer->id }}-{{ $offer->inquiry_date }} {{ $offer->name }}
                                                </a>
                                            @endforeach
                                        @endif
                                    </td>

                                    <td>
                                        <a class="btn btn-sm btn-success float-right" style="margin: 0 8px;"
                                           href="{{ route('client.edit', $client->id) }}"><i
                                                class="fas fa-edit"></i></a>
                                        <form class="float-right" action="{{ route('client.destroy', $client->id) }}"
                                              method="post" onsubmit="return confirm('Do you really want to delete?');">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" type="submit"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
