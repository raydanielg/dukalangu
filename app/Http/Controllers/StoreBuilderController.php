<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Str;

class StoreBuilderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show all stores list
    public function index()
    {
        $stores = Store::where('user_id', auth()->id())
            ->with(['products', 'orders'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('dashboard.store.index', compact('stores'));
    }

    // Show builder form (create or edit)
    public function create()
    {
        $store = Store::where('user_id', auth()->id())->first();
        return view('dashboard.store.builder', compact('store'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'template' => 'required|in:modern,classic,minimal,elegant',
        ]);

        // Handle logo upload
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('store-logos', 'public');
        }

        // Generate unique slug
        $slug = Str::slug($validated['name']);
        $originalSlug = $slug;
        $counter = 1;
        while (Store::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Create or update store
        $store = Store::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'name' => $validated['name'],
                'slug' => $slug,
                'description' => $validated['description'],
                'phone' => $validated['phone'],
                'whatsapp' => $validated['whatsapp'],
                'logo' => $logoPath,
                'template' => $validated['template'],
                'is_active' => true,
            ]
        );

        return redirect()->route('store.builder')
            ->with('success', 'Store created successfully! Your store link: ' . url('/store/' . $slug));
    }
}
