<div class="container">
    <h2>{{ __('ui.uploadedArticles') }}</h2>
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
        @forelse ($articles as $article)
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ Str::limit($article->body, 100) }}</p>
                        <p class="card-text"> {{ __('ui.publishedAt') }} {{ $article->created_at->format('d/m/Y') }}</p>
                        <button wire:click="deleteArticle({{ $article->id }})" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('ui.deleteArticle') }}')">
                            <i class="fas fa-trash"></i> {{ __('ui.delete') }}
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 mt-3">
                <p>{{ __('ui.noArticles') }}</p>
            </div>
        @endforelse
    </div>
    <div class="d-flex justify-content-center mt-3">
        {{ $articles->links() }}
    </div>
</div>
