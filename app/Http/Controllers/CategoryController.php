<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $query = Category::query();
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('category_name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }
        $categories = $query->latest()->paginate(10)->withQueryString();
        return view('category.index', ['categories' => $categories]);


    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lastId = Category::max('id') ?? 0;
        $nextId = $lastId + 1;
        return view('category.create', compact('nextId'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories,category_name|min:3',
            'description' => 'required',
        ]);

        Category::create($validated);

        return redirect()->route('category.index')->with([
            'message' => 'Data berhasil ditambahkan',
            'alert-type' => 'primary'
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::find($id);
        return view('category.edit',compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categories = Category::find($id);
        $categories->category_name = $request->category_name;
        $categories->description = $request->description;
        $categories->update();

        return redirect()->route('category.index')->with([
            'message' => 'Data berhasil diedit',
            'alert-type' => 'warning'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = Category::find($id);
        $categories->delete();
        // return redirect()->route('category.index')->with('success', 'Data berhasil dihapus');
        return redirect()->route('category.index')->with([
            'message' => 'Data berhasil dihapus',
            'alert-type' => 'danger' // merah
        ]);


    }
}
