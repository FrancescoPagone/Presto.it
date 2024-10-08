<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class UserArticles extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function deleteArticle($articleId)
    {
        $article = Article::findOrFail($articleId);
        if ($article->user_id === Auth::id()) {
            $article->delete();
            session()->flash('success', 'Articolo eliminato con successo.');
        }
    }

    public function render()
    {
        $articles = Article::where('user_id', auth()->id())->latest()->paginate(4);
        return view('livewire.user-articles', compact('articles'));
    }
}
