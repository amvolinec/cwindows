@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Name') }}</div>

                    <div class="card-body">

                        <form action="{{ route('client.create') }}">
                            <button class="btn btn-success mb-3">+</button>
                        </form>

                        <table class="table table-sm">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __("Title") }}</th>
								<th scope="col">{{ __("Contact name") }}</th>
								<th scope="col">{{ __("Phone") }}</th>
								<th scope="col">{{ __("E-mail") }}</th>
								<th scope="col">{{ __("Address") }}</th>
								<th scope="col">{{ __("City") }}</th>

                                <th scope="col">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients AS $client)
                                <tr>
                                    <th scope="row">{{ $client->id  }}</th>
                                    <td>{{ $client->title }}</td>
									<td>{{ $client->contact }}</td>
									<td>{{ $client->phone }}</td>
									<td>{{ $client->email }}</td>
									<td>{{ $client->address }}</td>
									<td>{{ $client->city }}</td>

                                    <td>
                                        <a class="btn btn-sm btn-success float-right" style="margin: 0 8px;"
                                           href="{{ route('client.edit', $client->id) }}">{{ __('Edit') }}</a>
                                        <form class="float-right" action="{{ route('client.destroy', $client->id) }}"
                                              method="post" onsubmit="return confirm('Do you really want to delete?');">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" type="submit">{{ __('Delete') }}</button>
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
