@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-inline-block" style="vertical-align: top;">
                            <form action="{{ route('company.create') }}">
                                @method('post')
                                @csrf
                                <button class="btn btn-success">+</button>
                            </form>
                        </div>
                        <div class="d-inline-block" style="vertical-align: top; padding: 6px;">
                            <h4 >{{ __('Companies') }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped">
                            <thead class="thead">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __("Name") }}</th>
								<th scope="col">{{ __("Phone") }}</th>
								<th scope="col">{{ __("Email") }}</th>
								<th scope="col">{{ __("Address") }}</th>
								<th scope="col">{{ __("Code") }}</th>
								<th scope="col">{{ __("Account") }}</th>
								<th scope="col">{{ __("Vat Code") }}</th>

                                <th scope="col">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companies AS $company)
                                <tr>
                                    <th scope="row">{{ $company->id  }}</th>
                                    <td>{{ $company->name }}</td>
									<td>{{ $company->phone }}</td>
									<td>{{ $company->email }}</td>
									<td>{{ $company->address }}</td>
									<td>{{ $company->code }}</td>
									<td>{{ $company->account }}</td>
									<td>{{ $company->vat_code }}</td>

                                    <td>
                                        <form class="float-right" action="{{ route('company.destroy', $company->id) }}"
                                              method="post" onsubmit="return confirm('Do you really want to delete?');">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-outline-danger" type="submit"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <a class="btn btn-sm btn-outline-success float-right" style="margin: 0 8px;"
                                           href="{{ route('company.edit', $company->id) }}"><i class="fas fa-edit"></i></a>
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
