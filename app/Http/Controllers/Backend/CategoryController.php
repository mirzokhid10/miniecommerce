<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::with('translations')
            ->whereNull('parent_id')
            ->get();

        return view(
            'admin.category.create',
            compact('categories')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request, CategoryService $service)
    {

        $service->create($request->validated());

        notify()->success('Category created.');
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        $categories = Category::with('translations')
            ->whereNull('parent_id')
            ->get();
        return view('admin.category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category, CategoryService $service)
    {
        $service->update($category, $request->validated());

        notify()->success('Category updated.');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Category $category, CategoryService $service)
    {
        $service->delete($category);

        notify()->success('Category deleted.');
        return redirect()->back();
    }

    public function changeStatus(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();

        // return notify()->success('Category Status Changed Successfully!');
        return response()->json(['message' => 'Category Status Changed Successfully!']);
    }
}
