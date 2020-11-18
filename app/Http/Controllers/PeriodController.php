<?php

namespace App\Http\Controllers;

use App\Period;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $periods = Period::paginate(20);
        return view('period.index', ['periods' => $periods]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('period.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        Period::create($request->except('_method', '_token'));
        return redirect()->route('period.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return View
     */
    public function show($id)
    {
        return view('period.index', ['periods' => Period::where('id', $id)->paginate()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Period  $period
     * @return View
     */
    public function edit(Period $period)
    {
        return view ('period.create' , ['period' => $period]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Period  $period
     * @return RedirectResponse
     */
    public function update(Request $request, Period $period)
    {
        $period->fill($request->except('_method', '_token'))->save();
        return redirect()->route('period.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Period  $period
     * @return RedirectResponse
     */
    public function destroy(Period $period)
    {
        $period->delete();
        return redirect()->route('period.index');
    }

    public function find(Request $request, $search = false)
    {
        $string = $search ?? $request->get('string');

        $data = Period::where('name', 'like', '%' . $string . '%')
            // ->orWhere('title', 'like', '%' . $string . '%')
            ;

        if ($search !== false && !empty($search)) {
            return view('period.index', ['periods' => $data->paginate(20), 'search' => $string]);
        } else {
            return $data->take(10)->get();
        }
    }
}
