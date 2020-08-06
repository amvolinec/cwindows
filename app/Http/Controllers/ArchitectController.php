<?php

namespace App\Http\Controllers;

use App\Architect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArchitectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $architects = Architect::all();
        return view('architect.index', ['architects' => $architects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('architect.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        Architect::create($request->except('_method', '_token'));
        return redirect()->route('architect.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Architect  $architect
     * @return RedirectResponse
     */
    public function show(Architect $architect)
    {
        return redirect()->route('architect.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Architect  $architect
     * @return View
     */
    public function edit(Architect $architect)
    {
        return view ('architect.create' , ['architect' => $architect]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Architect  $architect
     * @return RedirectResponse
     */
    public function update(Request $request, Architect $architect)
    {
        $architect->fill($request->except('_method', '_token'))->save();
        return redirect()->route('architect.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Architect  $architect
     * @return RedirectResponse
     */
    public function destroy(Architect $architect)
    {
        $architect->delete();
        return redirect()->route('architect.index');
    }
}
