<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        $user = auth()->user();
        return view('dashboard.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'bio' => 'nullable|string|max:500',
            'phone' => 'required|string|max:20',
            'phone_alt_1' => 'nullable|string|max:20',
            'phone_alt_2' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                \Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($validated);

        return redirect()->route('profile.edit')
            ->with('success', 'Profile updated successfully!');
    }

    public function storeSettings()
    {
        $store = Store::where('user_id', auth()->id())->first();
        return view('dashboard.profile.store', compact('store'));
    }
}
