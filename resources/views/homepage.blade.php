<x-layout>
    @foreach (['errorMessage' => 'danger', 'message' => 'success'] as $key => $type)
        @if (session()->has($key))
            <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
                <i class="bi {{ $type == 'danger' ? 'bi-exclamation-triangle-fill' : 'bi-check-circle-fill' }} me-2"></i>
                {{ session()->get($key) }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    @endforeach

    {{-- Loader --}}
    <!-- <div id="loader-wrapper">
        <div class="loader-content">
            <img src="{{ asset('img/LOGOpresto.png') }}" alt="Presto.it Logo" class="loader-logo">
            <div class="loader-spinner"></div>
            <p class="loading-text">Caricamento in corso...</p>
        </div>
    </div> -->


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
                                <a href="{{ route('products', $category->id) }}"
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
    <div class="d-none d-lg-block mb-3 mt-4">
        <div class="d-flex flex-wrap justify-content-center align-items-center gap-2">
            <a href="{{ route('products') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                <i class="fas fa-cubes-stacked me-1"></i>
                {{ __('ui.allCategories') }}
            </a>
            @foreach ($categories as $category)
                <a href="{{ route('products', $category->id) }}" class="btn btn-outline-secondary btn-sm rounded-pill">
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

    {{-- Sezione Carosello --}}
    <div class="carousel-container">
        @foreach ($carouselSlides as $index => $slide)
            <div class="carousel-slide {{ $index === 0 ? 'active' : '' }}">
                <div class="carousel-overlay"></div>
                <img src="{{ asset($slide['image']) }}" alt="Slide {{ $index + 1 }}" class="carousel-image">
                <div class="carousel-content">
                    <h2>{{ __($slide['title']) }}</h2>
                    <p>{{ __($slide['description']) }}</p>
                    <a href="{{ route($slide['buttonLink']) }}"
                        class="btn hero-button rounded-4">{{ __($slide['buttonText']) }}</a>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Sezione Ultimi Annunci --}}
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-5">{{ __('ui.latestAds') }}</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach ($article as $article)
                <div class="col-10 col-md-3 mb-4 position-relative">
                    <div class="new-badge rounded-pill">
                        {{ __('ui.new') }}
                    </div>
                    <x-card btnLink="{{ route('products.show', $article) }}" :article="$article" />
                </div>
            @endforeach
        </div>
        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="{{ route('products') }}" class="btn log-in-button rounded-pill">{{ __('ui.showMore') }}</a>
            </div>
        </div>
    </div>

    {{-- Sezione Recensioni Clienti --}}
    <section class="client-reviews py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 font-weight-bold">{{ __('ui.clientReviews') }}</h2>
            <div class="row">
                @foreach ($reviews as $review)
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="review-card h-100 shadow-sm rounded-4 bg-white p-4">
                            <div class="review-image mb-3">
                                <img src="/img/{{ $review['image'] }}" alt="{{ $review['name'] }}"
                                    class="img-fluid rounded-circle mx-auto d-block">
                            </div>
                            <div class="review-content text-center">
                                <h4 class="client-name mb-2">{{ $review['name'] }}</h4>
                                <div class="rating mb-3">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= floor($review['rating']))
                                            <i class="fas fa-star text-warning"></i>
                                        @elseif ($i - 0.5 == $review['rating'])
                                            <i class="fas fa-star-half-alt text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                </div>
                                <p class="review-text">"{{ $review['text'] }}"</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Sezione Vantaggi di Presto.it --}}
    <section class="benefits py-5 bg-white">
        <div class="container">
            <h2 class="text-center mb-5 font-weight-bold">{{ __('ui.whyChoosePresto') }}</h2>
            <div class="row justify-content-center align-items-stretch">
                <div class="col-md-4 mb-4">
                    <div class="benefit-card text-center p-4 rounded-4 shadow h-100 bg-light">
                        <i class="fas fa-hand-holding-usd fa-3x mb-3 text-success"></i>
                        <h4 class="mb-3">{{ __('ui.guaranteedSavings') }}</h4>
                        <p class="mb-0">{{ __('ui.guaranteedSavingsDescription') }}</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="benefit-card text-center p-4 rounded-4 shadow h-100 bg-light">
                        <i class="fas fa-rocket fa-3x mb-3 text-primary"></i>
                        <h4 class="mb-3">{{ __('ui.easeOfUse') }}</h4>
                        <p class="mb-0">{{ __('ui.easeOfUseDescription') }}</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="benefit-card text-center p-4 rounded-4 shadow h-100 bg-light">
                        <i class="fas fa-leaf fa-3x mb-3 text-info"></i>
                        <h4 class="mb-3">{{ __('ui.sustainability') }}</h4>
                        <p class="mb-0">{{ __('ui.sustainabilityDescription') }}</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('products') }}" class="btn log-in-button btn-lg rounded-pill ">{{ __('ui.exploreAds') }}</a>
            </div>
        </div>
    </section>
</x-layout>
