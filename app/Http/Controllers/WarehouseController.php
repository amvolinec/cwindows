<?php

namespace App\Http\Controllers;

use App\Warehouse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $warehouses = Warehouse::paginate(20);
        return view('warehouse.index', ['warehouses' => $warehouses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('warehouse.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        Warehouse::create($request->except('_method', '_token'));
        return redirect()->route('warehouse.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return View
     */
    public function show($id)
    {
        return view('warehouse.index', ['warehouses' => Warehouse::where('id', $id)->paginate()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Warehouse  $warehouse
     * @return View
     */
    public function edit(Warehouse $warehouse)
    {
        return view ('warehouse.create' , ['warehouse' => $warehouse]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Warehouse  $warehouse
     * @return RedirectResponse
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        $warehouse->fill($request->except('_method', '_token'))->save();
        return redirect()->route('warehouse.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Warehouse  $warehouse
     * @return RedirectResponse
     */
    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();
        return redirect()->route('warehouse.index');
    }

    public function find(Request $request, $search = false)
    {
        $string = $search ? $search : $request->get('string');

        $data = Warehouse::where('name', 'like', '%' . $string . '%')
            // ->orWhere('title', 'like', '%' . $string . '%')
            ;

        if ($search !== false && !empty($search)) {
            return view('warehouse.index', ['warehouses' => $data->paginate(20), 'search' => $string]);
        } else {
            return $data->take(10)->get();
        }
    }
}
