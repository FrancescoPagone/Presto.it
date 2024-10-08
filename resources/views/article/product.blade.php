@props([
    'categoryIcons' => [
        '1' => ['shirt'],
        '2' => ['bag-shopping'],
        '3' => ['laptop'],
        '4' => ['couch'],
        '5' => ['car-side'],
        '6' => ['spray-can-sparkles'],
        '7' => ['shirt'],
        '8' => ['baby-carriage'],
        '9' => ['utensils'],
        '10' => ['heart-pulse'],
    ],
])

<x-layout>
    <div class="container-fluid mt-4">

        {{-- Sezione Categorie --}}
        <div class="d-lg-none">
            <div class="accordion accordion-flush mb-3" id="categoryAccordion">
                <div class="accordion-item border-0">
                    <h2 class="accordion-header" id="headingCategories">
                        <button class="accordion-button collapsed bg-light text-dark" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseCategories" aria-expanded="false"
                            aria-controls="collapseCategories">
                            Categorie
                        </button>
                    </h2>
                    <div id="collapseCategories" class="accordion-collapse collapse" aria-labelledby="headingCategories"
                        data-bs-parent="#categoryAccordion">
                        <div class="accordion-body bg-white">
                            <div class="d-flex flex-wrap justify-content-center gap-2">
                                <a href="{{ route('products') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                                    <i class="fas fa-cubes-stacked me-1"></i>
                                    {{ __('ui.allCategories') }}
                                </a>
                                @foreach ($categories as $category)
                                    <a href="{{ route('products', ['category' => $category->id]) }}"
                                        class="btn btn-outline-secondary btn-sm rounded-pill">
                                        @if (isset($categoryIcons[$category->id]))
                                            @foreach ($categoryIcons[$category->id] as $icon)
                                                <i class="fas fa-{{ $icon }} me-1"></i>
                                            @endforeach
                                        @endif
                                        {{ Str::limit(__("ui.{$category->category}"), 10) }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-none d-lg-block mb-3 mt-2">
            <div class="d-flex flex-wrap justify-content-center align-items-center gap-2">
                <a href="{{ route('products') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                    <i class="fas fa-cubes-stacked me-1"></i>
                    {{ __('ui.allCategories') }}
                </a>
                @foreach ($categories as $category)
                    <a href="{{ route('products', ['category' => $category->id]) }}"
                        class="btn btn-outline-secondary btn-sm rounded-pill">
                        @if (isset($categoryIcons[$category->id]))
                            @foreach ($categoryIcons[$category->id] as $icon)
                                <i class="fas fa-{{ $icon }} me-1"></i>
                            @endforeach
                        @endif
                        {{ Str::limit(__("ui.{$category->category}"), 10) }}
                    </a>
                @endforeach
            </div>
        </div>

    </div>

    <div class="container">

        {{-- ==========breadcrumb========== --}}

        <div class="col-12 my-3 ms-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}"
                            class="text-decoration-none text-muted">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('products') }}"
                            class="text-decoration-none text-muted">{{ __('ui.products') }}</a></li>
                </ol>
            </nav>
        </div>

        {{-- ==========tutti gli annunci========== --}}


        <div class="container">
            <h1 class="text-center mb-5">
                @if (request()->has('category'))
                    {{ __('ui.' . ($categories->firstWhere('id', request()->category)->category ?? 'Categoria non trovata')) }}
                @else
                    {{ __('ui.allProducts') }}
                @endif
            </h1>
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

            <div class="row g-4">
                @forelse ($articles as $article)
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <x-card btnLink="{{ route('products.show', compact('article')) }}" :article="$article" />
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5 bg-light rounded shadow-sm">
                            <h3 class="mb-4 text-muted">{{ __('ui.noArticlesLoaded') }}</h3>
                            <p class="text-muted mb-4">{{ __('ui.noArticlesLoadedDescription') }}</p>
                            <a href="{{ route('create') }}" class="btn log-in-button rounded-pill">
                                <i class="fas fa-plus me-2"></i> {{ __('ui.loadArticle') }}
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $articles->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</x-layout>
