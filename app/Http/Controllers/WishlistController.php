<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;

class WishlistController extends Controller
{
    public function toggle(Article $article)
    {
        $user = auth()->user();

        if ($user->wishlist->contains($article->id)) {
            $user->wishlist()->detach($article);
            $message = 'Articolo rimosso dalla wishlist';
        } else {
            $user->wishlist()->attach($article);
            $message = 'Articolo aggiunto alla wishlist';
        }

        return back()->with('success', $message);
    }

    public function index()
    {
        $user = auth()->user();
        $wishlistItems = $user->wishlist()->paginate(10);

        return view('wishlist.index', compact('wishlistItems'));
    }
}
