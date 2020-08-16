<?php

namespace App\Http\Controllers;

use App\Site;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $sites = Site::all();
        return view('site.index', ['sites' => $sites]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('site.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        Site::create($request->except('_method', '_token'));
        return redirect()->route('site.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Site  $site
     * @return RedirectResponse
     */
    public function show(Site $site)
    {
        return redirect()->route('site.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Site  $site
     * @return View
     */
    public function edit(Site $site)
    {
        return view ('site.create' , ['site' => $site]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Site  $site
     * @return RedirectResponse
     */
    public function update(Request $request, Site $site)
    {
        $site->fill($request->except('_method', '_token'))->save();
        return redirect()->route('site.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Site  $site
     * @return RedirectResponse
     */
    public function destroy(Site $site)
    {
        $site->delete();
        return redirect()->route('site.index');
    }
}
