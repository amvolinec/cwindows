<?php

namespace App\Http\Controllers;

use App\Company;
use App\Traits\SearchTrait;
use App\Traits\SettingTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CompanyController extends Controller
{
    use SettingTrait;
    use SearchTrait;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $companies = Company::with('offers', 'clients')->where('setting_id', $request->user()->setting_id)->get();
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
        $companies = Company::create($request->except('_method', '_token'));
        $companies->setting_id = $this->getSettingId();
        $companies->save();


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
            $companies = Company::where('setting_id', $request->user()->setting_id)
                ->where('name', 'like', '%' . $request->get('name') . '%')
                ->get();
        } else {
            $companies = [];
        }
        return $companies;
    }

    public function find(Request $request, $search = false)
    {
        list($query, $bindings) = $this->getQuery($request, $search, 'name,phone,address,email', true);

        if ($search !== false && !empty($search)) {

            $companies = Company::with('offers', 'clients')->whereRaw($query, $bindings)->paginate(20);
            return view('company.index', ['companies' => $companies, 'search' => $request->get('string')]);

        } else {

            return DB::table("companies")->whereRaw($query, $bindings)->take(10)->get();

        }
    }
}
