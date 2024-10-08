<x-layout>
    <div class="my_bg">
        <section class="p-3 p-md-4 p-xl-5 body-login">
            <div class=" py-3 py-md-5">
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-12 col-md-11 col-lg-8 col-xl-7 col-xxl-6">
                            <div class="bg-white p-4 p-md-5 rounded shadow-sm">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-center mb-5">
                                            <a href="{{ route('homepage') }}">
                                                <img src="img\LOGOpresto.png" alt="BootstrapBrain Logo" width="150">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('homepage') }}"
                                                class="text-decoration-none text-muted">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ __('ui.login') }}</li>
                                    </ol>
                                </nav>
                                <!-- form login -->
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="row gy-3 gy-md-4 overflow-hidden">
                                        <div class="col-12">
                                            <label for="email" class="form-label">{{ __('ui.email') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                                        <path
                                                            d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                                    </svg>
                                                </span>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    id="email">
                                            </div>
                                            @error('email')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="password" class="form-label">{{ __('ui.password') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                                                        <path
                                                            d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
                                                        <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                                    </svg>
                                                </span>
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" id="password" value="">
                                            </div>
                                            @error('password')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-lg log-in-button"
                                                    type="submit">{{ __('ui.login') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- /form login -->
                                <div class="row">
                                    <div class="col-12">
                                        <hr class="mt-5 mb-4 border-secondary-subtle">
                                        <div class="d-flex gap-1 flex-column flex-md-row justify-content-md-center">
                                            <span> {{ __('ui.noAccount') }} </span>
                                            <a href="{{ route('register') }}" class="">{{ __('ui.register') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-layout>
