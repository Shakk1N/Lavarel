<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index()
    {
        return response()->json(['data' => BlogCategory::all()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|string|unique:blog_categories',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|integer',
        ]);

        $category = BlogCategory::create($validated);

        return response()->json(['data' => $category], 201);
    }

    public function show($id)
    {
        $category = BlogCategory::findOrFail($id);
        return response()->json(['data' => $category]);
    }

    public function update(Request $request, $id)
    {
        $category = BlogCategory::findOrFail($id);
        $category->update($request->all());
        return response()->json(['data' => $category]);
    }

    public function destroy($id)
    {
        BlogCategory::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted']);
    }
}

