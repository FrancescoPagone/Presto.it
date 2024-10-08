<x-layout>
    <div class="container my-5 min-vh-100">
        <h1 class="mb-4 text-center">
            <i class="bi bi-heart-fill text-danger me-2"></i>{{ __('ui.myWishlist') }}
        </h1>

        <div class="row">
            @if($wishlistItems->count() > 0)
                <div class="row g-4">
                    @foreach($wishlistItems as $article)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card border-0 product-card">
                                @if($article->images->count() > 0)
                                    <img src="{{ $article->images->first()->getUrl(300, 300) }}" class="card-img-top" alt="{{ $article->title }}">
                                @else
                                    <img src="{{ asset('img/placeholder.png') }}" class="card-img-top" alt="Placeholder">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $article->title }}</h5>
                                    <p class="card-text">{{ Str::limit($article->body, 100) }}</p>
                                    <p class="card-text"><strong>{{ $article->price }}€</strong></p>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('products.show', $article) }}" class="btn btn-success">{{ __('ui.viewDetails') }}</a>
                                        <form action="{{ route('wishlist.toggle', $article) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger text-truncate">
                                                <i class="bi bi-heart-fill me-2"></i>{{ __('ui.removeFromWishlist') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $wishlistItems->links() }}
                </div>
            @else
                <div class="text-center py-5 bg-light rounded shadow-sm">
                    <h3 class="mb-4 text-muted">{{ __('ui.noItemsInWishlist') }}</h3>
                    <p class="text-muted mb-4">{{ __('ui.noItemsInWishlistDescription') }}</p>
                    <a href="{{ route('products') }}" class="btn log-in-button rounded-pill">
                        <i class="fas fa-plus me-2"></i> {{ __('ui.exploreAds') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-layout>