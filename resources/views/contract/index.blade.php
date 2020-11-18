@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-inline-block" style="vertical-align: top;">
                            <form action="{{ route('contract.create') }}">
                                @method('post')
                                @csrf
                                <button class="btn btn-success">+</button>
                            </form>
                        </div>
                        <div class="d-inline-block" style="vertical-align: top; padding: 6px;">
                            <h4 >{{ __('Contracts') }}</h4>
                        </div>
                        <find route="contract" fields="" search="{{ $search ?? '' }}"></find>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped table-responsive-md">
                            <thead class="thead">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __("Signed_at") }}</th>
                                <th scope="col">{{ __("Planed_at") }}</th>
                                <th scope="col">{{ __("Finished_at") }}</th>
                                <th scope="col">{{ __("Warranted_at") }}</th>
                                <th scope="col">{{ __("Client_id") }}</th>
                                <th scope="col">{{ __("Company_id") }}</th>
                                <th scope="col">{{ __("Manager_id") }}</th>
                                <th scope="col">{{ __("Address") }}</th>
                                <th scope="col">{{ __("Amount") }}</th>
                                <th scope="col">{{ __("Payments") }}</th>
                                <th scope="col">{{ __("Maintenance_id") }}</th>
                                <th scope="col">{{ __("Expenses") }}</th>
                                <th scope="col">{{ __("Margin") }}</th>
                                <th scope="col">{{ __("Period_id") }}</th>
                                <th scope="col">{{ __("Production_start") }}</th>
                                <th scope="col">{{ __("Production_end") }}</th>
                                <th scope="col">{{ __("Production_number") }}</th>
                                <th scope="col">{{ __("Installation_start") }}</th>
                                <th scope="col">{{ __("Installation_end") }}</th>
                                <th scope="col">{{ __("Installation_note") }}</th>

                                <th scope="col" style="width: 100px;">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contracts AS $contract)
                                <tr>
                                    <th scope="row">{{ $contract->id  }}</th>
                                    <td>{{ $contract->signed_at }}</td>
                                    <td>{{ $contract->planed_at }}</td>
                                    <td>{{ $contract->finished_at }}</td>
                                    <td>{{ $contract->warranted_at }}</td>
                                    <td>{{ $contract->client_id }}</td>
                                    <td>{{ $contract->company_id }}</td>
                                    <td>{{ $contract->manager_id }}</td>
                                    <td>{{ $contract->address }}</td>
                                    <td>{{ $contract->amount }}</td>
                                    <td>{{ $contract->payments }}</td>
                                    <td>{{ $contract->maintenance_id }}</td>
                                    <td>{{ $contract->expenses }}</td>
                                    <td>{{ $contract->margin }}</td>
                                    <td>{{ $contract->period_id }}</td>
                                    <td>{{ $contract->production_start }}</td>
                                    <td>{{ $contract->production_end }}</td>
                                    <td>{{ $contract->production_number }}</td>
                                    <td>{{ $contract->installation_start }}</td>
                                    <td>{{ $contract->installation_end }}</td>
                                    <td>{{ $contract->installation_note }}</td>
                                    <td>
                                        <form class="float-right" action="{{ route('contract.destroy', $contract->id) }}"
                                              method="post" onsubmit="return confirm('Do you really want to delete?');">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-outline-danger" type="submit"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <a class="btn btn-sm btn-outline-success float-right" style="margin: 0 8px;"
                                           href="{{ route('contract.edit', $contract->id) }}"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $contracts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

