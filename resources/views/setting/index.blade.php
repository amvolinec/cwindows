@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-inline-block" style="vertical-align: top;">
                            <form action="{{ route('setting.create') }}">
                                @method('post')
                                @csrf
                                <button class="btn btn-success">+</button>
                            </form>
                        </div>
                        <div class="d-inline-block" style="vertical-align: top; padding: 6px;">
                            <h4 >{{ __('Settings') }}</h4>
                        </div>
                        <find route="setting" fields="" search="{{ $search ?? '' }}"></find>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped table-responsive-md">
                            <thead class="thead">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __("Name") }}</th>
								<th scope="col">{{ __("Code") }}</th>
								<th scope="col">{{ __("Vat Code") }}</th>
								<th scope="col">{{ __("Address") }}</th>
								<th scope="col">{{ __("Phone") }}</th>
								<th scope="col">{{ __("Account") }}</th>
								<th scope="col">{{ __("Email") }}</th>
								<th scope="col">{{ __("Web") }}</th>
								<th scope="col">{{ __("Logo Name") }}</th>
								<th scope="col">{{ __("Logo") }}</th>
								<th scope="col">{{ __("Currency") }}</th>

                                <th scope="col" style="width: 100px;">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($settings AS $setting)
                                <tr>
                                    <th scope="row">{{ $setting->id  }}</th>
                                    <td>{{ $setting->name }}</td>
									<td>{{ $setting->code }}</td>
									<td>{{ $setting->vat_code }}</td>
									<td>{{ $setting->address }}</td>
									<td>{{ $setting->phone }}</td>
									<td>{{ $setting->account }}</td>
									<td>{{ $setting->email }}</td>
									<td>{{ $setting->web }}</td>
									<td>{{ $setting->file_name }}</td>
									<td>{{ $setting->file_uri }}</td>
									<td>{{ $setting->currency->currency ?? '' }}</td>

                                    <td>
                                        <form class="float-right" action="{{ route('setting.destroy', $setting->id) }}"
                                              method="post" onsubmit="return confirm('Do you really want to delete?');">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-outline-danger" type="submit"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <a class="btn btn-sm btn-outline-success float-right" style="margin: 0 8px;"
                                           href="{{ route('setting.edit', $setting->id) }}"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $settings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
