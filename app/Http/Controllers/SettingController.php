<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $settings = Setting::paginate(20);
        return view('setting.index', ['settings' => $settings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('setting.create', ['currencies' => Currency::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {

        $path = null;
        $file_name = '';

        if ($request->hasFile('file')) {
            $file_name = $request->file('file')->getClientOriginalName();
            $path = Storage::disk('uploads')->putFile('images', $request->file('file'));

        }

        $setting = Setting::create($request->except('_method', '_token'));

        if (!empty($path)) {
            $setting->file_name = $file_name;
            $setting->file_uri = $path;
            $setting->save();
        }

        return redirect()->route('setting.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return View
     */
    public function show($id)
    {
        return view('setting.index', ['settings' => Setting::where('id', $id)->paginate()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Setting  $setting
     * @return View
     */
    public function edit(Setting $setting)
    {
        return view ('setting.create' , ['setting' => $setting, 'currencies' => Currency::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Setting  $setting
     * @return RedirectResponse
     */
    public function update(Request $request, Setting $setting)
    {
        $setting->fill($request->except('_method', '_token', 'file'));

        $path = null;
        $file_name = '';

        if ($request->hasFile('file')) {
            $file_name = $request->file('file')->getClientOriginalName();
            $path = Storage::disk('uploads')->putFile('images', $request->file('file'));
        }

        if (!empty($path)) {
            $setting->file_name = $file_name;
            $setting->file_uri = $path;
        }

        $setting->save();

        return redirect()->route('setting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Setting  $setting
     * @return RedirectResponse
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();
        return redirect()->route('setting.index');
    }

    public function find(Request $request, $search = false)
    {
        $string = $search ?? $request->get('string');

        $data = Setting::where('name', 'like', '%' . $string . '%')
            // ->orWhere('title', 'like', '%' . $string . '%')
            ;

        if ($search !== false && !empty($search)) {
            return view('setting.index', ['settings' => $data->paginate(20), 'search' => $string]);
        } else {
            return $data->take(10)->get();
        }
    }
}
