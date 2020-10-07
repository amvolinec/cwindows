<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  Setting  $setting
     * @return View
     */
    public function edit()
    {
        $setting = Setting::find(1);
        if(empty($setting)){
            $setting = Setting::create(['name' => 'Doleta']);
        }
        return view ('setting.create' , ['setting' => $setting]);
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
        $setting = Setting::findOrFail(1);
        $setting->fill($request->except('_method', '_token'))->save();
        return redirect()->route('setting.edit');
    }
}
