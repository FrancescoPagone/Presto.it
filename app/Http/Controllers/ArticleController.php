<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function create()
    {
        return view('article.create');
    }

    public function index(Request $request)
    {
        $categories = Category::all();
        $articles = Article::where('is_accepted', true)->orderby('created_at', 'desc');

        if ($request->has('category')) {
            $categoryId = $request->get('category');
            $articles = $articles->where('category_id', $request->get('category'));
        }

        $articles = $articles->paginate(8);

        return view('article.product', compact('articles', 'categories'));
    }


    public function show(Article $article)
    {
        return view('article.detail', compact('article'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $articles = Article::search($query)->where('is_accepted', true)->orderby('created_at', 'desc')->paginate(8);
        return view('article.searched', ['articles' => $articles, 'query' => $query]);
    }
}
