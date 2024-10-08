<x-layout>
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

    <div class="container-fluid min-vh-100 py-5">
        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-10 col-lg-8">
                <h1 class="display-4 text-center fw-bold">{{ __('ui.revisorDashboard') }}</h1>
                <hr class="my-4">
            </div>
        </div>
        @if ($article_to_check)
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 mb-5">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                        <div class="row g-0 h-100">
                            <div class="col-md-6 position-relative">
                                <div id="articleCarousel" class="carousel slide h-100" data-bs-ride="carousel">
                                    <div class="carousel-inner h-100">
                                        @if ($article_to_check->images->count())
                                            @foreach ($article_to_check->images as $key => $image)
                                                <div class="carousel-item h-100 {{ $key == 0 ? 'active' : '' }}">
                                                    <img src="{{ $image->getUrl(300, 300) }}"
                                                        class="d-block w-100 h-100 object-fit-cover"
                                                        alt="Immagine {{ $key + 1 }} dell'articolo {{ $article_to_check->title }}">
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="carousel-item h-100 active">
                                                <img src="{{ asset('img/placeholder.png') }}"
                                                    class="d-block w-100 h-100 object-fit-cover"
                                                    alt="Placeholder image">
                                            </div>
                                        @endif
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#articleCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#articleCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                                <span
                                    class="position-absolute top-0 start-0 bg-success text-white px-3 py-2 m-3 rounded-pill fs-6 fw-bold backdropFilter">
                                    {{ __('ui.' . $article_to_check->category->category) }}
                                </span>
                            </div>

                            <div class="col-md-6 d-flex flex-column">
                                <div class="card-body d-flex flex-column h-100 p-4">
                                    <h2 class="card-title h3 mb-2 fw-bold">{{ $article_to_check->title }}</h2>
                                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-2">
                                        <p class="card-text text-muted mb-1 mb-md-0 d-flex align-items-center">
                                            <i class="bi bi-person-circle me-2 fs-5"></i>
                                            <span>{{ $article_to_check->user->name }}</span>
                                        </p>
                                        <p class="card-text text-success fw-bold mb-0 fs-4">
                                            $ {{ $article_to_check->price }}
                                        </p>
                                    </div>

                                    <div class="mb-2 d-flex flex-wrap">
                                        <p class="me-3 mb-1"><i
                                                class="bi bi-calendar3 me-2"></i>{{ $article_to_check->created_at->format('M d, Y') }}
                                        </p>
                                        <p class="mb-1"><i
                                                class="bi bi-tag me-2"></i>{{ __('ui.' . $article_to_check->category->category) }}
                                        </p>
                                    </div>

                                    <div class="mb-2 overflow-auto" style="max-height: 150px;">
                                        <p class="card-text fs-6">{{ $article_to_check->body }}</p>
                                    </div>

                                    <div id="imageAnalysisSection" class="mb-3">
                                        @foreach ($article_to_check->images as $key => $image)
                                            <div class="image-analysis {{ $key == 0 ? 'd-block' : 'd-none' }}">
                                                <div class="bg-light bg-opacity-75 rounded p-3">
                                                    <h5 class="fw-bold mb-2">Image {{ $key + 1 }} Analysis</h5>
                                                    <div class="row g-2">
                                                        <div class="col-sm-6">
                                                            <h6 class="fw-bold text-start mb-1">Labels</h6>
                                                            @if ($image->labels)
                                                                <div class="d-flex flex-wrap gap-1">
                                                                    @foreach ($image->labels as $label)
                                                                        <span
                                                                            class="badge bg-secondary">{{ $label }}</span>
                                                                    @endforeach
                                                                </div>
                                                            @else
                                                                <p class="fst-italic text-muted small">No labels found
                                                                </p>
                                                            @endif
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <h6 class="fw-bold mb-1">Content Ratings</h6>
                                                            @foreach (['adult', 'medical', 'violence', 'racy', 'spoof'] as $rating)
                                                                <div
                                                                    class="d-flex w-75 justify-content-between align-items-center">
                                                                    <span
                                                                        class="text-capitalize small">{{ $rating }}</span>
                                                                    <div
                                                                        class="d-flex {{ $image->$rating }} justify-content-between align-items-center">
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div
                                        class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-auto gap-2">
                                        <form action="{{ route('reject', ['article' => $article_to_check]) }}"
                                            method="post" class="w-100">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-outline-danger rounded-pill px-4 py-2 w-100">
                                                <i class="bi bi-x-circle me-2"></i>{{ __('ui.reject') }}
                                            </button>
                                        </form>
                                        <form action="{{ route('accept', ['article' => $article_to_check]) }}"
                                            method="post" class="w-100">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-success rounded-pill px-4 py-2 w-100">
                                                <i class="bi bi-check-circle me-2"></i>{{ __('ui.accept') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card border-0 shadow-lg rounded-4 text-center p-4 p-sm-5">
                        <div class="card-body">
                            <i class="bi bi-clipboard-check display-1 text-muted mb-4"></i>
                            <h2 class="display-6 fw-bold mb-4">{{ __('ui.noArticleToCheck') }}</h2>
                            <p class="lead text-muted mb-5">{{ __('ui.noArticleToCheckDescription') }}</p>
                            <a class="btn log-in-button btn-lg rounded-pill px-4 py-3" href="{{ route('homepage') }}">
                                <i class="fas fa-home me-2"></i>{{ __('ui.returnToHomepage') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-layout>
