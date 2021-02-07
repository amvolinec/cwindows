@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-inline-block" style="vertical-align: top;">
                            <form action="{{ route('contact.create') }}">
                                @method('post')
                                @csrf
                                <button class="btn btn-success">+</button>
                            </form>
                        </div>
                        <div class="d-inline-block" style="vertical-align: top; padding: 6px;">
                            <h4>{{ __('Contacts') }}</h4>
                        </div>
                        <find route="contact" fields="name,email,phone,address" search="{{ $search ?? '' }}"></find>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped">
                            <thead class="thead">
                            <tr>
                                <th scope="col">{{ __("Name") }}</th>
                                <th scope="col">{{ __("Code") }}</th>
                                <th scope="col">{{ __("Phone") }}</th>
                                <th scope="col">{{ __("Address") }}</th>
                                <th scope="col">{{ __("Email") }}</th>
                                <th scope="col">{{ __("City") }}</th>
                                <th scope="col">{{ __("Company name") }}</th>
                                <th scope="col">{{ __("Comment") }}</th>

                                <th scope="col">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts AS $contact)
                                <tr>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->code}}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>{{ $contact->address }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->city }}</td>
                                    <td>{{ $contact->firm->name ?? '' }}</td>
                                    <td>{{ $contact->comment }}</td>
                                    <td>
                                    <td>
                                        <a class="btn btn-sm btn-success float-right" style="margin: 0 8px;"
                                           href="{{ route('contact.edit', $contact->id) }}"><i
                                                class="fas fa-edit"></i></a>
                                        <form class="float-right" action="{{ route('contact.destroy', $contact->id) }}"
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

