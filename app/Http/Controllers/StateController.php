<?php

namespace App\Http\Controllers;

use App\Offer;
use App\State;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $states = State::all();
        return view('state.index', ['states' => $states]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('state.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        State::create($request->except('_method', '_token'));
        return redirect()->route('state.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  State  $state
     * @return RedirectResponse
     */
    public function show(State $state)
    {
        return redirect()->route('state.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  State  $state
     * @return View
     */
    public function edit(State $state)
    {
        return view ('state.create' , ['state' => $state]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  State  $state
     * @return RedirectResponse
     */
    public function update(Request $request, State $state)
    {
        $state->fill($request->except('_method', '_token'))->save();
        return redirect()->route('state.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  State  $state
     * @return RedirectResponse
     */
    public function destroy(State $state)
    {
        $state->delete();
        return redirect()->route('state.index');
    }

    public function getStates(){
        return [
            'states' => State::all(),
            'users' => User::all(),
            'user_id' => Auth::id(),
            'managers' => User::role('manager')->get()
            ];
    }
}
