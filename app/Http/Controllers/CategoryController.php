<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::where('user_id', auth()->id())
            ->orderBy('sort_order')
            ->get();
        return view('dashboard.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
        ]);

        $slug = Str::slug($validated['name']);
        $originalSlug = $slug;
        $counter = 1;
        while (Category::where('slug', $slug)->where('user_id', auth()->id())->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        Category::create([
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'],
            'sort_order' => Category::where('user_id', auth()->id())->count() + 1,
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully!');
    }
}
