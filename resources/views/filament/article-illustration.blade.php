@php
    $illustration = $record->getIllustration();
    if (!$illustration) {
        return;
    }
    $url = $illustration->url();
@endphp

<div style="display: flex; justify-content: center">
    <a href="{{ $url }}" target="_blank">
        <img
            src="{{ $url }}"
            class="fi-sc-image"
            style="height: 14rem"
        />
    </a>
</div>
