<x-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-4 homeWrite">
                    <a href="#become-revisor-form"class="text-decoration-none text-dark">{{ __('ui.becomeRevisor') }}</a>
                </h2>
                <p class="lead text-center mb-5">{{ __('ui.becomeRevisorDescription') }}</p>
                <h3 class="text-center">
                    <a href="#become-revisor-form"class="text-decoration-none text-dark">{{ __('ui.benefits') }}</a>
                </h3>

                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <ul class="list-unstyled profile-work" style="font-weight: 400; font-size: 18px;">
                            <li class="mb-2 mt-3"><i
                                    class="fas fa-check-circle text-success me-2"></i>{{ __('ui.createTrust') }}</li>
                            <li class="mb-2"><i
                                    class="fas fa-check-circle text-success me-2"></i>{{ __('ui.communityExpert') }}</li>
                            <li class="mb-2"><i
                                    class="fas fa-check-circle text-success me-2"></i>{{ __('ui.rewardsContribution') }}</li>
                            <li class="mb-2"><i
                                    class="fas fa-check-circle text-success me-2"></i>{{ __('ui.improveSkills') }}</li>
                            <li class="mb-2"><i
                                    class="fas fa-check-circle text-success me-2"></i>{{ __('ui.accessNewProducts') }}</li>
                            <li class=""><i
                                    class="fas fa-check-circle text-success me-2"></i>{{ __('ui.improvePresto') }}</li>
                        </ul>
                    </div>
                </div>

                <div id="become-revisor-form" class="mb-5 emp-profile">
                    <h2 class="text-center mb-4 profile-head"><a href="#become-revisor-form"
                            class="text-decoration-none text-dark">{{ __('ui.becomeRevisor') }}</a></h2>
                    <form action="{{ route('become.revisor') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="description"
                                class="form-label profile-tab">{{ __('ui.whyBecomeRevisor') }}</label>
                            <textarea name="description" id="description" rows="5"
                                class="form-control textarea-custom @error('description') is-invalid @enderror"
                                placeholder="{{ __('ui.whyBecomeRevisorPlaceholder') }}"></textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn log-in-button mt-2">{{ __('ui.send') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
