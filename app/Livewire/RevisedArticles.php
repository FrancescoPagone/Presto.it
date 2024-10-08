<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Article;


class RevisedArticles extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function resubmitArticle($articleId)
    {
        $article = Article::findOrFail($articleId);
        $article->setAccepted(null);
        $article->save();
        session()->flash('success', 'Articolo reinviato per la revisione.');
    }

    public function render()
    {
        $checked = Article::where('is_accepted', true)->latest('updated_at')->paginate(4);
        return view('livewire.revised-articles', compact('checked'));
    }
}
