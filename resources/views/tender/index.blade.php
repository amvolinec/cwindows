@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-inline-block" style="vertical-align: top;">
                            <form action="{{ route('tender.create') }}">
                                @method('post')
                                @csrf
                                <button class="btn btn-success">+</button>
                            </form>
                        </div>
                        <div class="d-inline-block" style="vertical-align: top; padding: 6px;">
                            <h4 >{{ __('Tenders') }}</h4>
                        </div>
                        <find route="tender" fields="" search="{{ $search ?? '' }}"></find>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped table-responsive-md">
                            <thead class="thead">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __("Manager") }}</th>
								<th scope="col">{{ __("Delivery Address") }}</th>
								<th scope="col">{{ __("Version") }}</th>
								<th scope="col">{{ __("Profile") }}</th>
								<th scope="col">{{ __("Materials") }}</th>
								<th scope="col">{{ __("Colors") }}</th>
								<th scope="col">{{ __("Squaring") }}</th>
								<th scope="col">{{ __("Meters") }}</th>
								<th scope="col">{{ __("Total With VAT") }}</th>
								<th scope="col">{{ __("Cost") }}</th>
								<th scope="col">{{ __("Expenses") }}</th>
								<th scope="col">{{ __("Comments") }}</th>
								<th scope="col">{{ __("State") }}</th>
								<th scope="col">{{ __("Offer") }}</th>
								<th scope="col">{{ __("Total") }}</th>

                                <th scope="col" style="width: 100px;">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tenders AS $tender)
                                <tr>
                                    <th scope="row">{{ $tender->id  }}</th>
                                    <td>{{ $tender->managers->name }}</td>
									<td>{{ $tender->delivery_address }}</td>
									<td>{{ $tender->version }}</td>
									<td>{{ $tender->profiles->name }}</td>
									<td>{{ $tender->materials }}</td>
									<td>{{ $tender->colors }}</td>
									<td>{{ $tender->squaring }}</td>
									<td>{{ $tender->meters }}</td>
									<td>{{ $tender->total_with_vat }}</td>
									<td>{{ $tender->cost }}</td>
									<td>{{ $tender->expenses }}</td>
									<td>{{ $tender->comments }}</td>
									<td>{{ $tender->state }}</td>
									<td>{{ $tender->offers->title }}</td>
									<td>{{ $tender->total }}</td>

                                    <td>
                                        <form class="float-right" action="{{ route('tender.destroy', $tender->id) }}"
                                              method="post" onsubmit="return confirm('Do you really want to delete?');">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-outline-danger" type="submit"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <a class="btn btn-sm btn-outline-success float-right" style="margin: 0 8px;"
                                           href="{{ route('tender.edit', $tender->id) }}"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $tenders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
