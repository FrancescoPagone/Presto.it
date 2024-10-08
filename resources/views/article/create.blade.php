<x-layout>
    <div class=" d-flex align-items-center imgBackground position-relative">
        <div class="imgBackground2"></div>
        <div class="container-fluid py-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-header bgColor text-white py-3 rounded-top-4">
                            <h1 class="text-center mb-0 fw-bold">{{ __('ui.createArticle') }}</h1>
                        </div>
                        <div class="card-body p-4">
                            @livewire('article-create')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
