@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-inline-block" style="vertical-align: top;">
                            <form action="{{ route('warehouse.create') }}">
                                @method('post')
                                @csrf
                                <button class="btn btn-success">+</button>
                            </form>
                        </div>
                        <div class="d-inline-block" style="vertical-align: top; padding: 6px;">
                            <h4 >{{ __('Warehouses') }}</h4>
                        </div>
                        <find route="warehouse" fields="code,name" search="{{ $search ?? '' }}"></find>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped">
                            <thead class="thead">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __("Code") }}</th>
								<th scope="col">{{ __("Name") }}</th>

                                <th scope="col">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($warehouses AS $warehouse)
                                <tr>
                                    <th scope="row">{{ $warehouse->id  }}</th>
                                    <td>{{ $warehouse->code }}</td>
									<td>{{ $warehouse->name }}</td>

                                    <td>
                                        <form class="float-right" action="{{ route('warehouse.destroy', $warehouse->id) }}"
                                              method="post" onsubmit="return confirm('Do you really want to delete?');">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-outline-danger" type="submit"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <a class="btn btn-sm btn-outline-success float-right" style="margin: 0 8px;"
                                           href="{{ route('warehouse.edit', $warehouse->id) }}"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $warehouses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
