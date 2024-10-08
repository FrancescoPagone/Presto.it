<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $articles = Article::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(4);
        $checked = Article::where('user_id', Auth::id())->where('is_accepted', true)->orderBy('created_at', 'desc')->paginate(4);
        return view('auth.profile', compact('user', 'articles', 'checked'));
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = Auth::user();
        $user->profile_image = $request->file('profile_image')->store('profile_images', 'public');
        $user->save();

        return redirect()->back()->with('success', 'Immagine del profilo aggiornata con successo.');
    }

    public function show(User $user)
    {
        $articles = $user->articles()->latest()->paginate(6);
        return view('user.profile', compact('user', 'articles'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'bio' => 'nullable|string|max:1000',
            'facebook' => 'nullable|url',
            'linkedin' => 'nullable|url',
        ]);

        Auth::user()->update($validated);

        return redirect()->route('profile')->with('message', 'Profile updated successfully');
    }
}
