@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-inline-block" style="vertical-align: top;">
                            <form action="{{ route('transaction.create') }}">
                                @method('post')
                                @csrf
                                <button class="btn btn-success">+</button>
                            </form>
                        </div>
                        <div class="d-inline-block" style="vertical-align: top; padding: 6px;">
                            <h4 >{{ __('Transactions') }}</h4>
                        </div>
                        <find route="transaction" fields="" search="{{ $search ?? '' }}"></find>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped table-responsive-md">
                            <thead class="thead">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __("Offer") }}</th>
                                <th scope="col">{{ __("Amount") }}</th>
								<th scope="col">{{ __("Number") }}</th>
								<th scope="col">{{ __("State") }}</th>
								<th scope="col">{{ __("Transaction Type") }}</th>
								<th scope="col">{{ __("Info") }}</th>
								<th scope="col">{{ __("Details") }}</th>

                                <th scope="col" style="width: 100px;">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions AS $transaction)
                                <tr>
                                    <th scope="row">{{ $transaction->id  }}</th>
                                    <td>{{ $transaction->offer ? $transaction->offer->id . '-' . $transaction->offer->inquiry_date . ' ' . $transaction->offer->title : '' }}</td>
                                    <td>{{ $transaction->amount }}</td>
									<td>{{ $transaction->number }}</td>
									<td>{{ $transaction->state ?? '' }}</td>
									<td>{{ $transaction->transaction_type->name }}</td>
									<td>{{ $transaction->info }}</td>
									<td>{{ $transaction->details }}</td>

                                    <td>
                                        <form class="float-right" action="{{ route('transaction.destroy', $transaction->id) }}"
                                              method="post" onsubmit="return confirm('Do you really want to delete?');">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-outline-danger" type="submit"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <a class="btn btn-sm btn-outline-success float-right" style="margin: 0 8px;"
                                           href="{{ route('transaction.edit', $transaction->id) }}"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
