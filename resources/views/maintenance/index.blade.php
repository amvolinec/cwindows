@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-inline-block" style="vertical-align: top;">
                            <form action="{{ route('maintenance.create') }}">
                                @method('post')
                                @csrf
                                <button class="btn btn-success">+</button>
                            </form>
                        </div>
                        <div class="d-inline-block" style="vertical-align: top; padding: 6px;">
                            <h4 >{{ __('Maintenances') }}</h4>
                        </div>
                        <find route="maintenance" fields="name,email,phone,address" search="{{ $search ?? '' }}"></find>
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
								<th scope="col">{{ __("Comments") }}</th>

                                <th scope="col">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($maintenances AS $maintenance)
                                <tr>
                                    <th scope="row">{{ $maintenance->id  }}</th>
                                    <td>{{ $maintenance->name }}</td>
									<td>{{ $maintenance->phone }}</td>
									<td>{{ $maintenance->email }}</td>
									<td>{{ $maintenance->address }}</td>
									<td>{{ $maintenance->comments }}</td>

                                    <td>
                                        <form class="float-right" action="{{ route('maintenance.destroy', $maintenance->id) }}"
                                              method="post" onsubmit="return confirm('Do you really want to delete?');">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-outline-danger" type="submit"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <a class="btn btn-sm btn-outline-success float-right" style="margin: 0 8px;"
                                           href="{{ route('maintenance.edit', $maintenance->id) }}"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $maintenances->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
