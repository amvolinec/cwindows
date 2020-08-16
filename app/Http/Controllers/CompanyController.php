<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $companies = Company::all();
        return view('company.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        Company::create($request->except('_method', '_token'));
        return redirect()->route('company.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return View
     */
    public function show($id)
    {
        $companies = Company::where('id', $id)->get();
        return view('company.index', ['companies' => $companies]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return View
     */
    public function edit(Company $company)
    {
        return view('company.create', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Company $company
     * @return RedirectResponse
     */
    public function update(Request $request, Company $company)
    {
        $company->fill($request->except('_method', '_token'))->save();
        return redirect()->route('company.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return RedirectResponse
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('company.index');
    }

    public function getCompany(Request $request)
    {
        if ($request->has('name')) {
            $companies = Company::where('name', 'like', '%' . $request->get('name') . '%')->get();
        } else {
            $companies = [];
        }
        return $companies;
    }

    public function find(Request $request, $search = false)
    {
        $string = $search ? $search : $request->get('string');

        $data = Company::where('code', 'like', '%' . $string . '%')
            ->orWhere('name', 'like', '%' . $string . '%')
            ->orWhere('email', 'like', '%' . $string . '%')
            ->orWhere('phone', 'like', '%' . $string . '%')
            ->orWhere('address', 'like', '%' . $string . '%')
            ->take(10)->get();

        if ($search !== false && !empty($search)) {
            return view('company.index', ['companies' => $data, 'search' => $string]);
        } else {
            return $data;
        }
    }
}
