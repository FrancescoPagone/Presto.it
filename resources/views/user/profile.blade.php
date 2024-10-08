<x-layout>
    <div class="container-fluid py-5 bg-gradient-light">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5">
                    <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
                        <div class="card-body text-center p-5">
                            <img src="{{ $user->profile_image ? Storage::url($user->profile_image) : asset('img/default-profile.png') }}"
                                alt="{{ $user->name }}" class="rounded-circle img-fluid mb-4"
                                style="width: 200px; height: 200px; object-fit: cover; border: 6px solid #fff; box-shadow: 0 0 25px rgba(0,0,0,0.1);">
                            <h1 class="card-title font-weight-bold mb-3">{{ $user->name }}</h1>
                            <p class="text-muted mb-3"><i
                                    class="fas fa-calendar-alt mr-2"></i>{{ __('ui.memberSince') }}
                                {{ $user->created_at->format('M Y') }}</p>
                            <p class="mb-3">{{ $user->bio ?? __('ui.noBio') }}</p>
                            <div class="social-links mt-4">
                                @if ($user->facebook)
                                    <a href="{{ $user->facebook }}" class="btn btn-outline-primary mx-1"><i
                                            class="fab fa-facebook"></i></a>
                                @endif
                                @if ($user->linkedin)
                                    <a href="{{ $user->linkedin }}" class="btn btn-outline-primary mx-1"><i
                                            class="fab fa-linkedin"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <h2 class="mb-4 text-center font-weight-bold">{{ __('ui.userArticles') }}</h2>
                    <div class="row">
                        @forelse ($articles as $article)
                            @if ($article->is_accepted)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <x-card btnLink="{{ route('products.show', compact('article')) }}" :article="$article" />
                                </div>
                            @endif
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info text-center">
                                    <p class="mb-0">{{ __('ui.noRevisedArticles') }}</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
