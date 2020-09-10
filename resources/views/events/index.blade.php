@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-inline-block" style="vertical-align: top; padding: 6px;">
                            <h4>{{ __('Events') }}</h4>
                        </div>
                        <find route="event" fields="created_at,subject_type" search="{{ $search ?? '' }}"></find>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped">
                            <thead class="thead">
                            <tr>
                                <th scope="col" width="120px">{{ __("Data") }}</th>
                                <th scope="col">{{ __("User") }}</th>
                                <th scope="col">{{ __("Model") }}</th>
                                <th scope="col">{{ __("Description") }}</th>
                                <th scope="col">{{ __("Changes") }}</th>

                                <th scope="col">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events AS $event)
                                <tr>
                                    <td>{{ $event->created_at  }}</td>
                                    <td>{{ $event->user->name  }}</td>
                                    <td>
                                        <a href="{{ url($event->link) }}" target="_blank">
                                            {{ substr($event->subject_type, 4)  }}
                                        </a>
                                    </td>
                                    <td>{{ $event->description  }}</td>
                                    <td>
                                        @foreach($event->changes_only as $key=>$value)
                                            {{ $key }}
                                            : {{ isset($event->changes['old'][$key]) ? $event->changes['old'][$key] . ' => ' : '' }} {{ $value}}
                                        @endforeach
                                    </td>
                                    <td>
                                        <form class="float-right" action="{{ route('event.clear', $event->id) }}"
                                              method="post" onsubmit="return confirm('Do you really want to delete?');">
                                            @method('post')
                                            @csrf
                                            <button class="btn btn-sm btn-outline-danger" type="submit"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $events->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection


