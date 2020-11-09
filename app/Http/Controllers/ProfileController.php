<?php

namespace App\Http\Controllers;

use App\Color;
use App\Organization;
use App\Profile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        //$profiles = Profile::paginate(20);
        //return view('profile.index', ['profiles' => $profiles]);

        return view('profile.profiles');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {

        $path = null;
        $file_name = '';

        if ($request->hasFile('file')) {

            if (!$request->has('file_name')) {
                $file_name = $request->file('file')->getClientOriginalName();
            }

            $path = Storage::disk('uploads')->putFile('images', $request->file('file'));

        }

        $profile = Profile::create($request->except('_method', '_token'));

        if (!empty($path)) {
            $profile->file_name = $file_name;
            $profile->file_uri = $path;
            $profile->save();
        }

        return redirect()->route('profile.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return View
     */
    public function show($id)
    {
        return view('profile.index', ['profiles' => Profile::where('id', $id)->paginate()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Profile $profile
     * @return View
     */
    public function edit(Profile $profile)
    {
        return view('profile.create', ['profile' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Profile $profile
     * @return RedirectResponse
     */
    public function update(Request $request, Profile $profile)
    {
        $profile->fill($request->except('_method', '_token', 'file'));

        $path = null;
        $file_name = '';

        if ($request->hasFile('file')) {
            if (!$request->has('file_name')) {
                $file_name = $request->file('file')->getClientOriginalName();
            }
            $path = Storage::disk('uploads')->putFile('images', $request->file('file'));
        }

        if (!empty($path)) {
            $profile->file_name = $file_name;
            $profile->file_uri = $path;
        }

        $profile->save();

        return redirect()->route('profile.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Profile $profile
     * @return RedirectResponse
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();
        return redirect()->route('profile.index');
    }

    public function find(Request $request, $search = false)
    {
        $string = $search ?? $request->get('string');

        $data = Profile::where('name', 'like', '%' . $string . '%')
             ->orWhere('file_name', 'like', '%' . $string . '%')
              ->orWhere('price', '=', $string)
        ;

        if ($search !== false && !empty($search)) {
            return view('profile.index', ['profiles' => $data->paginate(20), 'search' => $string]);
        } else {
            return $data->take(10)->get();
        }
    }

    public function get()
    {
        return Profile::paginate(20);
    }

    public function search(Request $request)
    {
        $string = $request->get('search');

        return Profile::with('profiles')
            ->where('name', 'like', '%%' . $string . '%%')

            ->take(20)->get();
    }



}
