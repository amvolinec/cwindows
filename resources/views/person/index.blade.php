@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-inline-block" style="vertical-align: top;">
                            <form action="{{ route('person.create') }}">
                                @method('post')
                                @csrf
                                <button class="btn btn-success">+</button>
                            </form>
                        </div>
                        <div class="d-inline-block" style="vertical-align: top; padding: 6px;">
                            <h4>{{ __('People') }}</h4>
                        </div>
                        <find route="person" fields="name,email,phone,address" search="{{ $search ?? '' }}"></find>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped">
                            <thead class="thead">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __("Name") }}</th>
                                <th scope="col">{{ __("Email") }}</th>
                                <th scope="col">{{ __("Phone") }}</th>
                                <th scope="col">{{ __("Company Id") }}</th>
                                <th scope="col">{{ __("Address") }}</th>

                                <th scope="col">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($persons AS $person)
                                <tr>
                                    <th scope="row">{{ $person->id  }}</th>
                                    <td>{{ $person->name }}</td>
                                    <td>{{ $person->email }}</td>
                                    <td>{{ $person->phone }}</td>
                                    <td>{{ $person->company->name }}</td>
                                    <td>{{ $person->address }}</td>

                                    <td>
                                        <form class="float-right" action="{{ route('person.destroy', $person->id) }}"
                                              method="post" onsubmit="return confirm('Do you really want to delete?');">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-outline-danger" type="submit"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                        <a class="btn btn-sm btn-outline-success float-right" style="margin: 0 8px;"
                                           href="{{ route('person.edit', $person->id) }}"><i
                                                class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $persons->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
