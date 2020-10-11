<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Http\Requests\SettingRequest;
use App\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
     * @param  SettingRequest  $request
     * @return RedirectResponse
     */
    public function store(SettingRequest $request)
    {

        $path = null;
        $file_name = '';

        if ($request->hasFile('file')) {
            $file_name = $request->file('file')->getClientOriginalName();
            $path = Storage::disk('public')->putFile('uploads', $request->file('file'));
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
     * @param  SettingRequest  $request
     * @param  Setting  $setting
     * @return RedirectResponse
     */
    public function update(SettingRequest $request, Setting $setting)
    {
        $setting->fill($request->except('_method', '_token', 'file_uri'));

        $path = null;
        $file_name = '';

        if ($request->hasFile('file_uri')) {
            $file_name = $request->file('file_uri')->getClientOriginalName();
            $path = $request->file('file_uri')->store(
                'avatars/'.$request->user()->id, 'public'
            );
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

    public function get(Request $request){
        if(Auth::check()){
            return Setting::with('currency')->where('id', $request->user()->setting_id)->first();
        } else{
            return [];
        }
    }
}
