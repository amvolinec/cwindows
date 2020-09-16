@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-inline-block" style="vertical-align: top;">
                            <form action="{{ route('service.create') }}">
                                @method('post')
                                @csrf
                                <button class="btn btn-success">+</button>
                            </form>
                        </div>
                        <div class="d-inline-block" style="vertical-align: top; padding: 6px;">
                            <h4 >{{ __('Services') }}</h4>
                        </div>
                        <find route="service" fields="" search="{{ $search ?? '' }}"></find>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped table-responsive-md">
                            <thead class="thead">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __("Created At") }}</th>
                                <th scope="col">{{ __("Completion date") }}</th>
								<th scope="col">{{ __("State") }}</th>
								<th scope="col">{{ __("Costs") }}</th>
								<th scope="col">{{ __("Income") }}</th>
								<th scope="col">{{ __("Who Pays") }}</th>
								<th scope="col">{{ __("Warranty") }}</th>
								<th scope="col">{{ __("Notes") }}</th>
								<th scope="col">{{ __("List Of Orders") }}</th>
								<th scope="col">{{ __("Executor") }}</th>
								<th scope="col">{{ __("Offer") }}</th>
								<th scope="col">{{ __("Client") }}</th>
                                <th scope="col">{{ __("Manager") }}</th>
                                <th scope="col" style="width: 100px;">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services AS $service)
                                <tr>
                                    <th scope="row">{{ $service->id  }}</th>
                                    <td>{{ substr($service->created_at,0,10) }}</td>
                                    <td>{{ $service->completed_at }}</td>
									<td>{{ $service->state_name }}</td>
									<td>{{ $service->costs }}</td>
									<td>{{ $service->income }}</td>
									<td>{{ $service->payer_name }}</td>
									<td>{{ $service->warranty ? 'Yes' : 'No' }}</td>
									<td>{{ $service->notes }}</td>
									<td>{{ $service->list_of_orders }}</td>
									<td>{{ $service->executor }}</td>
									<td>{{ $service->offer->inquiry_date ? ($service->offer->inquiry_date.'-'.$service->offer->id.' '.$service->offer->title) : '' }}</td>
									<td>{{ $service->offer->client->name ?? '' }}</td>
                                    <td>{{ $service->manager->name ?? ''}}</td>
                                    <td>
                                        <form class="float-right" action="{{ route('service.destroy', $service->id) }}"
                                              method="post" onsubmit="return confirm('Do you really want to delete?');">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-outline-danger" type="submit"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <a class="btn btn-sm btn-outline-success float-right" style="margin: 0 8px;"
                                           href="{{ route('service.edit', $service->id) }}"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $services->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
