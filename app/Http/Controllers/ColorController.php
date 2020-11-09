<?php

namespace App\Http\Controllers;

use App\Annex;
use App\Color;
use App\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $colors = Color::paginate(20);
       // return view('color.index', ['colors' => $colors]);

        return view('color.colors');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('color.create');
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

        $color = Color::create($request->except('_method', '_token'));

        if (!empty($path)) {
            $color->file_name = $file_name;
            $color->file_uri = $path;
            $color->save();
        }

        return redirect()->route('color.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return View
     */
    public function show($id)
    {
        return view('color.index', ['colors' => Color::where('id', $id)->paginate()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Color  $color
     * @return View
     */
    public function edit(Color $color)
    {
        return view ('color.create' , ['color' => $color]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Color  $color
     * @return RedirectResponse
     */
    public function update(Request $request, Color $color)
    {
        $color->fill($request->except('_method', '_token', 'file'));

        $path = null;
        $file_name = '';

        if ($request->hasFile('file')) {
            $file_name = $request->file('file')->getClientOriginalName();
            $path = Storage::disk('uploads')->putFile('images', $request->file('file'));
        }

        if (!empty($path)) {
            $color->file_name = $file_name;
            $color->file_uri = $path;
        }

        $color->save();

        return redirect()->route('color.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Color  $color
     * @return RedirectResponse
     */
    public function destroy(Color $color)
    {
        $color->delete();
        return redirect()->route('color.index');
    }

    public function find(Request $request, $search = false)
    {
        $string = $search ?? $request->get('string');

        $data = Color::where('name', 'like', '%' . $string . '%')
            // ->orWhere('title', 'like', '%' . $string . '%')
            ;

        if ($search !== false && !empty($search)) {
            return view('color.index', ['colors' => $data->paginate(20), 'search' => $string]);
        } else {
            return $data->take(10)->get();
        }
    }

    public function get()
    {
        return Color::paginate(20);
    }

    public function search(Request $request)
    {
        $string = $request->get('search');

        return Color::with('colors')
            ->where('name', 'like', '%%' . $string . '%%')

            ->take(20)->get();
    }
}
