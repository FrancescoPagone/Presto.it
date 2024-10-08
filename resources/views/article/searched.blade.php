<x-layout>
    <div class="container mb-5">
        <div class="col-12 my-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}"
                            class="text-decoration-none text-muted">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('products') }}"
                            class="text-decoration-none text-muted">{{ __('ui.products') }}</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 mt-4">
                <h1 class="mb-4">{{ __('ui.resultsFor') }} <span
                        class="fst-italic text-success">{{ $query }}</span></h1>
            </div>
        </div>
        <div class="row g-4">
            @forelse ($articles as $article)
                <div class="col-12 col-md-6 col-lg-4">
                    <x-card btnLink="{{ route('products.show', compact('article')) }}" :article="$article" />
                </div>
            @empty
                <div class="col-12 min-vh-100 d-flex flex-column align-items-center justify-content-center">
                    <div class="text-center">
                        <i class="bi bi-search fs-1 text-muted mb-3"></i>
                        <h3 class="mb-4">{{ __('ui.noArticle') }}</h3>
                        <p class="text-muted mb-4">{{ __('ui.noArticleText') }}</p>
                        <a href="{{ route('create') }}" class="btn log-in-button">
                            + {{ __('ui.createArticle') }}
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    <div class="d-flex justify-content-center mt-5">
        {{ $articles->links('pagination::bootstrap-4') }}
    </div>
</x-layout>
