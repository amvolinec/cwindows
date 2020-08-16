<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $categories = Category::paginate(20);
        return view('category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        Category::create($request->except('_method', '_token'));
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return View
     */
    public function show($id)
    {
        return view('category.index', ['categories' => Category::where('id', $id)->paginate(10)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category  $category
     * @return View
     */
    public function edit(Category $category)
    {
        return view ('category.create' , ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Category  $category
     * @return RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        $category->fill($request->except('_method', '_token'))->save();
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category  $category
     * @return RedirectResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index');
    }

    public function find(Request $request, $search = false)
    {
        $string = $search ? $search : $request->get('string');

        $data = Category::where('name', 'like', '%' . $string . '%');
            // ->orWhere('title', 'like', '%' . $string . '%')

        if ($search !== false && !empty($search)) {
            return view('category.index', ['categories' => $data->paginate(20), 'search' => $string]);
        } else {
            return $data->take(10)->get();
        }
    }
}
