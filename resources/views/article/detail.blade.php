<x-layout>
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-12 my-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('homepage') }}"
                                class="text-decoration-none text-muted">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('products') }}"
                                class="text-decoration-none text-muted">{{ __('ui.products') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-4 mb-4">
                @if ($article->images->count() == 0)
                    <img src="{{ asset('img/placeholder.png') }}" class="img-fluid rounded shadow-lg"
                        alt="Placeholder image">
                @elseif ($article->images->count() == 1)
                    <img src="{{ $article->images->first()->getUrl(300, 300) }}"
                        alt="Immagine principale dell'articolo {{ $article->title }}"
                        class="img-fluid rounded shadow-lg">
                @else
                    <div class="swiper mySwiper2 shadow-lg rounded">
                        <div class="swiper-wrapper">
                            @foreach ($article->images as $key => $image)
                                <div class="swiper-slide">
                                    <img src="{{ $image->getUrl(300, 300) }}"
                                        alt="Immagine {{ $key + 1 }} dell'articolo {{ $article->title }}"
                                        class="img-fluid rounded">
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next text-white"></div>
                        <div class="swiper-button-prev text-white"></div>
                    </div>
                    <div thumbsSlider="" class="swiper mySwiper mt-3">
                        <div class="swiper-wrapper">
                            @foreach ($article->images as $key => $image)
                                <div class="swiper-slide">
                                    <img src="{{ $image->getUrl(300, 300) }}"
                                        alt="Thumbnail {{ $key + 1 }} dell'articolo {{ $article->title }}"
                                        class="img-fluid rounded">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-12 col-md-6 mt-4 mt-lg-0 d-flex flex-column justify-content-between">
                <div class="p-4 bg-white rounded-4 shadow-lg">
                    <span class="badge bg-green text-white mb-3"> {{ __("ui.{$article->category->category}") }}</span>
                    <h1 class="fw-bold mb-4 text-dark">{{ $article->title }}</h1>
                    <p class="fs-2 mb-3 fw-bold text-green"><i class="bi bi-tag-fill me-2"></i>{{ $article->price }}€
                    </p>
                    <p class="lead text-muted">
                        <i
                            class="bi bi-bookmark-fill me-2 text-green"></i><em>{{ __("ui.{$article->category->category}") }}</em>
                    </p>
                    <p class="lead text-muted">
                        <i class="bi bi-file-text-fill me-2 text-green"></i>{{ $article->body }}
                    </p>
                    @auth
                        <form action="{{ route('wishlist.toggle', $article) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="btn @if (auth()->user()->wishlist->contains($article)) btn-outline-danger @else btn-outline-success @endif mb-3">
                                <i
                                    class="bi @if (auth()->user()->wishlist->contains($article)) bi-heart-fill @else bi-heart @endif me-2"></i>
                                {{ auth()->user()->wishlist->contains($article) ? __('ui.removeFromWishlist') : __('ui.addToWishlist') }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-success mb-3">
                            <i class="bi bi-heart me-2"></i>{{ __('ui.addToWishlist') }}
                        </a>
                    @endauth
                    <hr class="my-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="mb-0 text-muted"><i
                                class="bi bi-calendar-event me-2 text-green"></i>{{ __('ui.createdAt') }}
                            {{ $article->created_at->format('d/m/Y') }}</p>
                        <p class="mb-0 text-muted"><i class="bi bi-person me-2 text-green"></i>
                            {{ __('ui.seller') }}
                            <a href="{{ route('user.profile', $article->user) }}"
                                class="text-decoration-none text-green">
                                {{ $article->user->name }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
