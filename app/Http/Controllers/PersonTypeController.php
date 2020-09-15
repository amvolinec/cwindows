<?php

namespace App\Http\Controllers;

use App\PersonType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PersonTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $person_types = PersonType::paginate(20);
        return view('persontype.index', ['person_types' => $person_types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('persontype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        PersonType::create($request->except('_method', '_token'));
        return redirect()->route('persontype.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return View
     */
    public function show($id)
    {
        return view('persontype.index', ['person_types' => PersonType::where('id', $id)->paginate()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  PersonType  $persontype
     * @return View
     */
    public function edit(PersonType $persontype)
    {
        return view ('persontype.create' , ['persontype' => $persontype]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  PersonType  $persontype
     * @return RedirectResponse
     */
    public function update(Request $request, PersonType $persontype)
    {
        $persontype->fill($request->except('_method', '_token'))->save();
        return redirect()->route('persontype.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PersonType  $persontype
     * @return RedirectResponse
     */
    public function destroy(PersonType $persontype)
    {
        $persontype->delete();
        return redirect()->route('persontype.index');
    }

    public function find(Request $request, $search = false)
    {
        $string = $search ?? $request->get('string');

        $data = PersonType::where('name', 'like', '%' . $string . '%')
            // ->orWhere('title', 'like', '%' . $string . '%')
            ;

        if ($search !== false && !empty($search)) {
            return view('persontype.index', ['person_types' => $data->paginate(20), 'search' => $string]);
        } else {
            return $data->take(10)->get();
        }
    }
}
