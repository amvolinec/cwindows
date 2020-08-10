@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Name') }}</div>

                    <div class="card-body">

                        <form action="{{ route('offer.create') }}">
                            <button class="btn btn-success mb-3">+</button>
                        </form>

                        <table class="table table-sm">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __("Date") }}</th>
								<th scope="col">{{ __("Client") }}</th>
								<th scope="col">{{ __("Architect") }}</th>
								<th scope="col">{{ __("Enquiry Date") }}</th>
								<th scope="col">{{ __("Price 1 Date") }}</th>
								<th scope="col">{{ __("Price 1") }}</th>
								<th scope="col">{{ __("Price 2 Date") }}</th>
								<th scope="col">{{ __("Price 2") }}</th>
								<th scope="col">{{ __("Price 3 Date") }}</th>
								<th scope="col">{{ __("Price 3") }}</th>
								<th scope="col">{{ __("Total") }}</th>
								<th scope="col">{{ __("Total With VAT") }}</th>
								<th scope="col">{{ __("Balance") }}</th>
								<th scope="col">{{ __("Other Services") }}</th>

                                <th scope="col">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($offers AS $offer)
                                <tr>
                                    <th scope="row">{{ $offer->id  }}</th>
                                    <td>{{ $offer->created_at }}</td>
									<td>{{ $offer->client->title }}</td>
									<td>{{ $offer->architect->title }}</td>
									<td>{{ $offer->enquiry_date }}</td>
									<td>{{ $offer->price_1_date }}</td>
									<td>{{ $offer->price_1 }}</td>
									<td>{{ $offer->price_2_date }}</td>
									<td>{{ $offer->price_2 }}</td>
									<td>{{ $offer->price_3_date }}</td>
									<td>{{ $offer->price_3 }}</td>
									<td>{{ $offer->total }}</td>
									<td>{{ $offer->total_with_vat }}</td>
									<td>{{ $offer->balance }}</td>
									<td>{{ $offer->other_services }}</td>

                                    <td>
                                        <a class="btn btn-sm btn-success float-right" style="margin: 0 8px;"
                                           href="{{ route('offer.edit', $offer->id) }}">{{ __('Edit') }}</a>
                                        <form class="float-right" action="{{ route('offer.destroy', $offer->id) }}"
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
