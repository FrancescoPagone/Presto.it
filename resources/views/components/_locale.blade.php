<form class="d-inline" action="{{ route('setLocale', $lang) }}" method="POST">
    @csrf
    <button type="submit" class="btn w-100 text-start">
        <img src="{{ asset('vendor/blade-flags/language-' . $lang . '.svg') }}" width="32" height="32" />
        <span class="text-capitalize ps-2">{{ $slot }}</span>
    </button>
</form>