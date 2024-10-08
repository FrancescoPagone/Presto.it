@props([
    'article' => '',
    'btnLink' => '',
])
<a href="{{ $btnLink }}" class="text-decoration-none text-dark">
    <div class="col-12">
        <div class="card product-card border-0 my-3 transition-hover rounded-4">
            <div class="imageContainer rounded-4">
                <div class="circle">{{ __('ui.viewMore') }}</div>
                <img src="{{ $article->images->isNotEmpty() ? $article->images->first()->getUrl(300, 300) : asset('img/placeholder.png') }}"
                    class="card-img-top w-100 h-100 object-fit-cover" alt="{{ $article->title }}">
            </div>
            <div class="card-body p-4">
                <span class="badge bg-light text-secondary mb-2">{{ __('ui.' . $article->category->category) }}</span>
                <h6 class="card-title mb-3 text-truncate">{{ $article->title }}</h6>
                <p class="card-text mb-3 text-truncate small text-muted">{{ $article->body }}</p>
                <p class="card-text text-end mb-3 text-success">€{{ $article->price }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">{{ $article->user->name }}</small>
                    <small class="text-muted">{{ $article->created_at->diffForHumans() }}</small>
                </div>
            </div>
        </div>
    </div>
</a>
