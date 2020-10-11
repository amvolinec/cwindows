@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Architects') }}</div>

                    <div class="card-body">

                        <form action="{{ route('architect.create') }}">
                            <button class="btn btn-success mb-3"><i class="fas fa-plus"></i></button>
                        </form>

                        <table class="table table-sm table-striped">
                            <thead class="thead">
                            <tr>
                                <th scope="col">{{ __("Title") }}</th>
								<th scope="col">{{ __("Phone") }}</th>
								<th scope="col">{{ __("Email") }}</th>
								<th scope="col">{{ __("Company") }}</th>

                                <th scope="col">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($architects AS $architect)
                                <tr>
                                    <td>{{ $architect->title }}</td>
									<td>{{ $architect->phone }}</td>
									<td>{{ $architect->email }}</td>
									<td>{{ $architect->company }}</td>

                                    <td>
                                        <a class="btn btn-sm btn-success float-right" style="margin: 0 8px;"
                                           href="{{ route('architect.edit', $architect->id) }}"><i class="fas fa-edit"></i></a>
                                        <form class="float-right" action="{{ route('architect.destroy', $architect->id) }}"
                                              method="post" onsubmit="return confirm('Do you really want to delete?');">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-trash"></i></button>
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
