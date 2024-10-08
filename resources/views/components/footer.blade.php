<section class="main-content ">
</section>
<div class="col-12">
    <footer class="py-4 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
                    <p class="mb-0 text-muted">&copy; 2024 AlleluIA, Inc</p>
                </div>
                <div class="col-md-4 text-center mb-3 mb-md-0">
                    <span class="text-muted me-2">Powered by</span>
                    <a href="/" class="text-decoration-none">
                        <img src="{{ asset('img/alleluia-verde.png') }}" alt="AlleluIA Logo" width="40"
                            height="40">
                    </a>
                </div>
                <div class="col-md-4">
                    <ul class="nav justify-content-center justify-content-md-end">
                        <li class="nav-item">
                            <a href="{{ route('homepage') }}" class="nav-link px-2 text-muted">{{ __('ui.home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('products') }}" class="nav-link px-2 text-muted">{{ __('ui.articles') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('become.revisor') }}" class="nav-link px-2 text-muted">{{ __('ui.workWithUs') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('profile') }}" class="nav-link px-2 text-muted">{{ __('ui.profile') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>
