@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-inline-block" style="vertical-align: top;">
                            <form action="{{ route('currency.create') }}">
                                @method('post')
                                @csrf
                                <button class="btn btn-success">+</button>
                            </form>
                        </div>
                        <div class="d-inline-block" style="vertical-align: top; padding: 6px;">
                            <h4 >{{ __('Currencies') }}</h4>
                        </div>
                        <find route="currency" fields="" search="{{ $search ?? '' }}"></find>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped table-responsive-md">
                            <thead class="thead">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __("Country") }}</th>
								<th scope="col">{{ __("Currency") }}</th>
								<th scope="col">{{ __("Code") }}</th>
								<th scope="col">{{ __("Symbol") }}</th>

                                <th scope="col" style="width: 100px;">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($currencies AS $currency)
                                <tr>
                                    <th scope="row">{{ $currency->id  }}</th>
                                    <td>{{ $currency->country }}</td>
									<td>{{ $currency->currency }}</td>
									<td>{{ $currency->code }}</td>
									<td>{{ $currency->symbol }}</td>

                                    <td>
                                        <form class="float-right" action="{{ route('currency.destroy', $currency->id) }}"
                                              method="post" onsubmit="return confirm('Do you really want to delete?');">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-outline-danger" type="submit"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <a class="btn btn-sm btn-outline-success float-right" style="margin: 0 8px;"
                                           href="{{ route('currency.edit', $currency->id) }}"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $currencies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
