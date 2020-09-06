<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $files = File::paginate(20);
        return view('file.index', ['files' => $files]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('file.create');
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

        $file = File::create($request->except('_method', '_token'));

        if (!empty($path)) {
            $file->file_name = $file_name;
            $file->file_uri = $path;
            $file->save();
        }

        return redirect()->route('file.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return View
     */
    public function show($id)
    {
        return view('file.index', ['files' => File::where('id', $id)->paginate()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  File  $file
     * @return View
     */
    public function edit(File $file)
    {
        return view ('file.create' , ['file' => $file]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  File  $file
     * @return RedirectResponse
     */
    public function update(Request $request, File $file)
    {
        $file->fill($request->except('_method', '_token', 'file'));

        $path = null;
        $file_name = '';

        if ($request->hasFile('file')) {
            $file_name = $request->file('file')->getClientOriginalName();
            $path = Storage::disk('uploads')->putFile('images', $request->file('file'));
        }

        if (!empty($path)) {
            $file->file_name = $file_name;
            $file->file_uri = $path;
        }

        $file->save();

        return redirect()->route('file.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  File  $file
     * @return RedirectResponse
     */
    public function destroy(File $file)
    {
        $file->delete();
        return redirect()->route('file.index');
    }

    public function find(Request $request, $search = false)
    {
        $string = $search ?? $request->get('string');

        $data = File::where('name', 'like', '%' . $string . '%')
            // ->orWhere('title', 'like', '%' . $string . '%')
            ;

        if ($search !== false && !empty($search)) {
            return view('file.index', ['files' => $data->paginate(20), 'search' => $string]);
        } else {
            return $data->take(10)->get();
        }
    }
}
