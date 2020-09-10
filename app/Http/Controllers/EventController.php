<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;

class EventController extends Controller
{
    public function index() {
        $events = Activity::paginate(20);
        return view('events.index', ['events' => $events]);
    }

    public function show($id) {
        $events = Activity::where('id', '=', $id)->paginate(20);
        return view('events.index', ['events' => $events]);
    }

    public function clear($id) {
        Activity::findOrFail($id)->delete();
        return redirect()->route('event.index');
    }

    public function find(Request $request, $search = false)
    {
        $string = $search ?? $request->get('string');

        $data = Activity::where('properties', 'like', '%' . $string . '%');

        if ($search !== false && !empty($search)) {
            return view('events.index', ['events' => $data->paginate(20), 'search' => $string]);
        } else if($request->has('string')) {
            return $data->take(10)->get();
        } else {
            throw new \Exception('Bad Data');
        }
    }
}
