@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-inline-block" style="vertical-align: top;">
                            <form action="{{ route('profile.create') }}">
                                @method('post')
                                @csrf
                                <button class="btn btn-success">+</button>
                            </form>
                        </div>
                        <div class="d-inline-block" style="vertical-align: top; padding: 6px;">
                            <h4>{{ __('Profiles') }}</h4>
                        </div>
                        <find route="profile" fields="name,file_name,price" search="{{ $search ?? '' }}"></find>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped">
                            <thead class="thead">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __("Name") }}</th>
                                <th scope="col">{{ __("Price") }}</th>
                                <th scope="col">{{ __("Index") }}</th>
                                <th scope="col">{{ __("File name") }}</th>
                                <th scope="col">{{ __("File") }}</th>

                                <th scope="col">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($profiles AS $profile)
                                <tr>
                                    <th scope="row">{{ $profile->id  }}</th>
                                    <td>{{ $profile->name }}</td>
                                    <td>{{ $profile->price }}</td>
                                    <td>{{ $profile->index }}</td>
                                    <td>{{ $profile->file_name }}</td>
                                    <td>
                                        <img src="{{ !empty($profile->file_uri) ? asset($profile->file_uri) : ''}}"
                                             alt="{{ $profile->file_name ?? '' }}" class="img-rounded">
                                    </td>

                                    <td>
                                        <form class="float-right" action="{{ route('profile.destroy', $profile->id) }}"
                                              method="post" onsubmit="return confirm('Do you really want to delete?');">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-outline-danger" type="submit"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                        <a class="btn btn-sm btn-outline-success float-right" style="margin: 0 8px;"
                                           href="{{ route('profile.edit', $profile->id) }}"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $profiles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
