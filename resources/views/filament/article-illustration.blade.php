@php
    $illustration = $record->getIllustration();
    if (!$illustration) {
        return;
    }
@endphp

<div style="display: flex; justify-content: center">
    <a href="{{ $illustration->url() }}" target="_blank">
        <img
            src="{{ $illustration->thumbnailUrl() }}"
            class="fi-sc-image"
            style="height: 14rem"
        />
    </a>
</div>
