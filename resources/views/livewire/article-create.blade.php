<form class=" p-3 my-5 " wire:submit='store' enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label">{{ __('ui.title') }}</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
            wire:model.live="title">
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">{{ __('ui.description') }}</label>
        <textarea class="form-control @error('body') is-invalid @enderror" cols="30" rows="10" id="body"
            wire:model.live="body"></textarea>
        @error('body')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">{{ __('ui.price') }}</label>
        <input min=0 type="number" class="form-control @error('price') is-invalid @enderror" id="price"
            wire:model.live="price">
        @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <select class="form-control @error('category') is-invalid @enderror" name="category" id="category"
            wire:model="category">
            <option label value=""> {{ __('ui.selectCategory') }} </option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"> {{ __("ui.{$category->category}") }} </option>
            @endforeach
        </select>
        @error('category')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <input type="file" wire:model.live="temporary_images" multiple
            class="form-control @error('temporary_images.*') is-invalid @enderror"
            placeholder="{{ __('ui.insertImages') }}">
        @error('temporary_images.*')
            <p class="fst-italic text-danger">{{ $message }}</p>
        @enderror
        @error('temporary_images')
            <p class="fst-italic text-danger">{{ $message }}</p>
        @enderror
    </div>

    @if (!empty($images))
        <div class="row">
            <div class="col-12">
                <p>{{ __('ui.previewImage') }}</p>
                <div class="row border border-4 rounded shadow py-4 mb-3">
                    @foreach ($images as $key => $image)
                        <div class="col d-flex flex-column align-items-center my-3">
                            <div class="img-preview mx-auto shadow rounded"
                                style="background-image: url({{ $image->temporaryUrl() }})"></div>
                            <button type="button" class="btn btn-danger mt-2"
                                wire:click="removeImage({{ $key }})">{{ __('ui.delete') }}</button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn log-in-button">{{ __('ui.add') }}</button>
    </div>



</form>
