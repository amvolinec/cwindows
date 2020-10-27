<?php

namespace App\Http\Controllers;

use App\Http\Requests\NameRequest;
use App\Maintenance;
use App\Traits\SearchTrait;
use App\Traits\SettingTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class MaintenanceController extends Controller
{
    use SettingTrait;
    use SearchTrait;

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request)
    {
        $maintenances = Maintenance::where('setting_id', $request->user()->setting_id)->paginate(20);
        return view('maintenance.index', ['maintenances' => $maintenances]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('maintenance.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NameRequest $request
     * @return RedirectResponse
     */
    public function store(NameRequest $request)
    {
        $maintenances = Maintenance::create($request->except('_method', '_token'));
        $maintenances ->setting_id = $request->user()->setting_id;
        $maintenances ->save();

        return redirect()->route('maintenance.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return View
     */
    public function show($id)
    {
        return view('maintenance.index', ['maintenances' => Maintenance::where('id', $id)->paginate()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Maintenance $maintenance
     * @return View
     */
    public function edit(Maintenance $maintenance)
    {
        return view('maintenance.create', ['maintenance' => $maintenance]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NameRequest $request
     * @param Maintenance $maintenance
     * @return RedirectResponse
     */
    public function update(NameRequest $request, Maintenance $maintenance)
    {
        $maintenance->fill($request->except('_method', '_token'))->save();
        return redirect()->route('maintenance.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Maintenance $maintenance
     * @return RedirectResponse
     */
    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        return redirect()->route('maintenance.index');
    }

    public function find(Request $request, $search = false)
    {
//        $string     = !empty($search) ? $search : $request->get('string');
//        $cols    = $request->has('columns') ? $request->get('columns') : 'name,phone,address,email';
//        $columns = explode(',', $cols);
//
//        $query = "{$columns[0]} like ? ";
//        $bindings = ["%{$string}%"];
//
//        if (count($columns) > 1) {
//            for ($i = 1; $i < count($columns); $i++) {
//                $query .= "or {$columns[$i]} like ? ";
//                array_push($bindings, "%{$string}%");
//            }
//        }
//
//        $data = DB::table("maintenances")->whereRaw($query, $bindings);
//        if ($search !== false && !empty($search)) {
//            return view('maintenance.index', ['maintenances' => $data->paginate(20), 'search' => $string]);
//        } else {
//            return $data->take(10)->get();
//        }

        list($query, $bindings) = $this->getQuery($request, $search, 'name,phone,address,email', true);

        if ($search !== false && !empty($search)) {

            $maintenances = Maintenance::whereRaw($query, $bindings)->paginate(20);
            return view('maintenance.index', ['maintenances' => $maintenances]);

        } else {

            return DB::table("maintenances")->whereRaw($query, $bindings)->get();

        }
    }
}
