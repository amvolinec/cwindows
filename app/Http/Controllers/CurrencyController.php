<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $currencies = Currency::paginate(20);
        return view('currency.index', ['currencies' => $currencies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('currency.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        Currency::create($request->except('_method', '_token'));
        return redirect()->route('currency.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return View
     */
    public function show($id)
    {
        return view('currency.index', ['currencies' => Currency::where('id', $id)->paginate()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Currency  $currency
     * @return View
     */
    public function edit(Currency $currency)
    {
        return view ('currency.create' , ['currency' => $currency]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Currency  $currency
     * @return RedirectResponse
     */
    public function update(Request $request, Currency $currency)
    {
        $currency->fill($request->except('_method', '_token'))->save();
        return redirect()->route('currency.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Currency  $currency
     * @return RedirectResponse
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();
        return redirect()->route('currency.index');
    }

    public function find(Request $request, $search = false)
    {
        $string = $search ?? $request->get('string');

        $data = Currency::where('name', 'like', '%' . $string . '%')
            // ->orWhere('title', 'like', '%' . $string . '%')
            ;

        if ($search !== false && !empty($search)) {
            return view('currency.index', ['currencies' => $data->paginate(20), 'search' => $string]);
        } else {
            return $data->take(10)->get();
        }
    }
}
