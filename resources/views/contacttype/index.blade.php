@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-inline-block" style="vertical-align: top;">
                            <form action="{{ route('contact_type.create') }}">
                                @method('post')
                                @csrf
                                <button class="btn btn-success">+</button>
                            </form>
                        </div>
                        <div class="d-inline-block" style="vertical-align: top; padding: 6px;">
                            <h4>{{ __('Contact types') }}</h4>
                        </div>
                        <find route="contact_type" fields="name,email,phone,address"
                              search="{{ $search ?? '' }}"></find>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped">
                            <thead class="thead">
                            <tr>
                                <th scope="col">{{ __("Name") }}</th>
                                <th scope="col">{{ __("Title") }}</th>
                                <th scope="col">{{ __("Description") }}</th>

                                <th scope="col">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contactTypes AS $contactType)
                                <tr>
                                    <td>{{ $contactType->name }}</td>
                                    <td>{{ $contactType->title}}</td>
                                    <td>{{ $contactType->description}}</td>

                                    <td>
                                    <td>
                                        <a class="btn btn-sm btn-success float-right" style="margin: 0 8px;"
                                           href="{{ route('contact_type.edit', $contactType->id) }}"><i
                                                class="fas fa-edit"></i></a>
                                        <form class="float-right"
                                              action="{{ route('contact_type.destroy', $contactType->id) }}"
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
                        {{ $contactTypes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


