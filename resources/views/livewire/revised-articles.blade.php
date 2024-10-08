<div class="container">
    <h2>{{ __('ui.revisedArticles') }}</h2>
    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        @forelse ($checked as $article)
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text">{{ Str::limit($article->body, 100) }}</p>
                            <p class="card-text">{{ __('ui.revisedAt') }}: {{ $article->updated_at->format('d/m/Y') }}</p>
                            <p class="card-text">{{ __('ui.status') }}: {{ $article->is_accepted ? 'Accettato' : 'Rifiutato' }}</p>
                        </div>
                        <button wire:click="resubmitArticle({{ $article->id }})" class="btn btn-outline-success">
                            <i class="fas fa-redo"></i> {{ __('ui.resubmit') }}
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 mt-3">
                <p>{{ __('ui.noRevisedArticles') }}</p>
            </div>
        @endforelse
    </div>
    <div class="d-flex justify-content-center mt-3">
        {{ $checked->links() }}
    </div>
</div>
