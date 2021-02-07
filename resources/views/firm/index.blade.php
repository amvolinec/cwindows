@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-inline-block" style="vertical-align: top;">
                            <form action="{{ route('firm.create') }}">
                                @method('post')
                                @csrf
                                <button class="btn btn-success">+</button>
                            </form>
                        </div>
                        <div class="d-inline-block" style="vertical-align: top; padding: 6px;">
                            <h4>{{ __('Firms') }}</h4>
                        </div>
                        <find route="contact" fields="name,phone,email" search="{{ $search ?? '' }}"></find>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped">
                            <thead class="thead">
                            <tr>
                                <th scope="col">{{ __("Code") }}</th>
                                <th scope="col">{{ __("Vat code") }}</th>
                                <th scope="col">{{ __("Company name") }}</th>
                                <th scope="col">{{ __("Bank account") }}</th>
                                <th scope="col">{{ __("Phone") }}</th>
                                <th scope="col">{{ __("Address") }}</th>
                                <th scope="col">{{ __("Email") }}</th>
                                <th scope="col">{{ __("City") }}</th>
                                <th scope="col">{{ __("Comment") }}</th>
                                <th scope="col">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($firms AS $firm)
                                <tr>
                                    <td>{{ $firm->code }}</td>
                                    <td>{{ $firm->vat_code}}</td>
                                    <td>{{ $firm->name }}</td>
                                    <td>{{ $firm->account }}</td>
                                    <td>{{ $firm->phone }}</td>
                                    <td>{{ $firm->address }}</td>
                                    <td>{{ $firm->email }}</td>
                                    <td>{{ $firm->city }}</td>
                                    <td>{{ $firm->comment }}</td>
                                    <td>
                                    <td>
                                        <a class="btn btn-sm btn-success float-right" style="margin: 0 8px;"
                                           href="{{ route('firm.edit', $firm->id) }}"><i
                                                class="fas fa-edit"></i></a>
                                        <form class="float-right" action="{{ route('firm.destroy', $firm->id) }}"
                                              method="post" onsubmit="return confirm('Do you really want to delete?');">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger" type="submit"><i
                                                    class="fas fa-trash"></i></button>
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


