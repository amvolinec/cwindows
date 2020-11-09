<?php

namespace App\Http\Controllers;

use App\Material;
use App\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $materials = Material::paginate(20);
        //return view('material.index', ['materials' => $materials]);

        return view('material.materials');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('material.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        list($file_name, $path) = $this->extractFile($request);

        $material = Material::create($request->except('_method', '_token', 'file_uri'));

        if (!empty($path)) {
            $material->file_name = $file_name;
            $material->file_uri = $path;
            $material->save();
        }

        return redirect()->route('material.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return View
     */
    public function show($id)
    {
        return view('material.index', ['materials' => Material::where('id', $id)->paginate()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Material  $material
     * @return View
     */
    public function edit(Material $material)
    {
        return view ('material.create' , ['material' => $material]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Material  $material
     * @return RedirectResponse
     */
    public function update(Request $request, Material $material)
    {
        $material->fill($request->except('_method', '_token', 'file'));

        list($file_name, $path) = $this->extractFile($request);

        if (!empty($path)) {
            $material->file_name = $file_name;
            $material->file_uri = $path;
        }

        $material->save();

        return redirect()->route('material.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Material  $material
     * @return RedirectResponse
     */
    public function destroy(Material $material)
    {
        $material->delete();
        return redirect()->route('material.index');
    }

    public function find(Request $request, $search = false)
    {
        $string = $search ?? $request->get('string');

        $data = Material::where('name', 'like', '%' . $string . '%');

        if ($search !== false && !empty($search)) {
            return view('material.index', ['materials' => $data->paginate(20), 'search' => $string]);
        } else {
            return $data->take(10)->get();
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function extractFile(Request $request): array
    {
        $file_name = null;
        $path = null;

        if ($request->hasFile('file_uri')) {
            $file_name = $request->file('file_uri')->getClientOriginalName();
            $path = $request->file('file_uri')->store(
                'materials/' . $request->user()->id, 'public'
            );
        }
        return array($file_name, $path);
    }

    public function get()
    {
        return Material::paginate(20);
    }


    public function search(Request $request)
    {
        $string = $request->get('search');

        return Material::with('materials')
            ->where('name', 'like', '%%' . $string . '%%')

            ->take(20)->get();
    }
}
