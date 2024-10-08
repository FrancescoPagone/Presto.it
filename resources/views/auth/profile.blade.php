<x-layout>
    <div class="container emp-profile">
        @foreach (['error' => 'danger', 'success' => 'success'] as $msgType => $alertType)
            @if (session()->has($msgType . 'Message'))
                <div class="alert alert-{{ $alertType }} alert-dismissible fade show" role="alert">
                    <i
                        class="bi bi-{{ $alertType == 'danger' ? 'exclamation-triangle' : 'check-circle' }}-fill me-2"></i>
                    {{ session()->get($msgType . 'Message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        @endforeach
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img-container position-relative">
                    <img src="{{ Auth::user()->profile_image ? Storage::url(Auth::user()->profile_image) : 'img/default-profile.png' }}"
                        alt="" class="profile-img rounded-circle " />
                    <form action="{{ route('profile.update-image') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="change-image-overlay btn btn-lg btn-primary">
                            <label for="file-input" class="change-image-btn">
                                {{ __('ui.changeImage') }}
                            </label>
                            <input type="file" id="file-input" class="d-none" name="profile_image"
                                onchange="this.form.submit()" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5 class="text-capitalize">
                        {{ Auth::user()->name }}
                    </h5>
                    <h6>
                        {{ __('ui.role') }}: {{ $user->is_revisor ? 'Revisore' : 'Utente' }}
                    </h6>
                    <a href="{{ route('create') }}" class=" btn log-in-button mt-3">
                        <svg class="me-2" style="width: 1.5vh" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512">
                            <path fill="#ffffff"
                                d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                        </svg> {{ __('ui.createArticle') }}
                    </a>

                    <!-- Menu for mobile -->
                    <div class="d-md-none mt-3">
                        <h6>Menu</h6>
                        <div class="d-flex flex-column">
                            <a href="#"
                                class="text-decoration-none text-dark fw-bold mb-2">{{ __('ui.profile') }}</a>
                            <a href="#"
                                class="text-decoration-none text-dark fw-bold mb-2">{{ __('ui.articles') }}</a>
                            @if (Auth::user()->is_revisor)
                                <a href="{{ route('revisor.index') }}"
                                    class="text-decoration-none text-dark fw-bold mb-2">{{ __('ui.revisorZone') }}</a>
                            @endif
                            <a href="#" class="text-decoration-none text-danger fw-bold mb-2"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> {{ __('ui.logout') }}
                            </a>
                        </div>
                    </div>

                    <ul class="nav nav-tabs pt-3 pt-md-5" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">{{ __('ui.info') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">{{ __('ui.createdArticles') }}</a>
                        </li>
                        @if (Auth::user()->is_revisor)
                            <li class="nav-item">
                                <a class="nav-link" id="revised-tab" data-toggle="tab" href="#revised" role="tab"
                                    aria-controls="revised" aria-selected="false">{{ __('ui.revisedArticles') }}</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                @if (Auth::user()->is_revisor)
                    <a href="{{ route('revisor.index') }}" class="btn btn-success btn-sm position-relative mb-2">
                        {{ __('ui.revisorZone') }}
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ \App\Models\Article::toBeRevisedCount() }}
                        </span>
                    </a>
                @endif
            </div>
        </div>
        <div class="row justify-content-between">
            <!-- Menu for desktop -->
            <div class="d-none d-md-block col-md-2 m-5">
                <h6>Menu</h6>
                <div class="d-flex flex-column">
                    <a href="#" class="text-decoration-none text-dark fw-bold mb-2">{{ __('ui.profile') }}</a>
                    <a href="#" class="text-decoration-none text-dark fw-bold mb-2">{{ __('ui.articles') }}</a>
                    @if (Auth::user()->is_revisor)
                        <a href="{{ route('revisor.index') }}"
                            class="text-decoration-none text-dark fw-bold mb-2">{{ __('ui.revisorZone') }}</a>
                    @endif
                    <a href="#" class="text-decoration-none text-danger fw-bold mb-2"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> {{ __('ui.logout') }}
                    </a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="user-info">
                            <h4 class="d-flex justify-content-between align-items-center">
                                {{ __('ui.userInfo') }}
                                <i class="fas fa-edit text-success edit-profile-btn" style="cursor: pointer;"
                                    title="{{ __('ui.editProfile') }}"></i>
                            </h4>
                            <div class="row mb-3">
                                <div class="col-md-6"><strong>{{ __('ui.name') }}:</strong></div>
                                <div class="col-md-6">{{ Auth::user()->name }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6"><strong>{{ __('ui.email') }}:</strong></div>
                                <div class="col-md-6">{{ Auth::user()->email }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6"><strong>{{ __('ui.bio') }}:</strong></div>
                                <div class="col-md-6">{{ Auth::user()->bio ?: __('ui.notProvided') }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6"><strong>{{ __('ui.facebook') }}:</strong></div>
                                <div class="col-md-6">{{ Auth::user()->facebook ?: __('ui.notProvided') }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6"><strong>{{ __('ui.linkedin') }}:</strong></div>
                                <div class="col-md-6">{{ Auth::user()->linkedin ?: __('ui.notProvided') }}</div>
                            </div>
                        </div>
                        <form action="{{ route('profile.update') }}" method="POST" class="d-none"
                            id="profileForm">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>{{ __('ui.name') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name"
                                        value="{{ Auth::user()->name }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>{{ __('ui.email') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email"
                                        value="{{ Auth::user()->email }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>{{ __('ui.bio') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="bio" rows="3">{{ Auth::user()->bio }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>{{ __('ui.facebook') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="url" class="form-control" name="facebook"
                                        value="{{ Auth::user()->facebook }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>{{ __('ui.linkedin') }}</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="url" class="form-control" name="linkedin"
                                        value="{{ Auth::user()->linkedin }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit"
                                        class="btn btn-success">{{ __('ui.updateProfile') }}</button>
                                    <button type="button"
                                        class="btn btn-danger cancel-edit-btn">{{ __('ui.cancel') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <livewire:user-articles />
                    </div>
                    @if (Auth::user()->is_revisor)
                        <div class="tab-pane fade" id="revised" role="tabpanel" aria-labelledby="revised-tab">
                            <livewire:revised-articles />
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>
