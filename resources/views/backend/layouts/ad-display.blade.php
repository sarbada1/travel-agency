@php
    // Get the ad for this position using ad repository
    $ad = app(\App\Repositories\Ad\AdInterface::class)->getAdForPosition($position);
    
    // Record impression if ad exists
    if ($ad) {
        app(\App\Repositories\Ad\AdInterface::class)->recordImpression($ad);
    }
@endphp

@if($ad)
<div class="ad-container my-4" data-ad-id="{{ $ad->id }}" data-position="{{ $position }}">
    @if($ad->type == 'image')
        <a href="{{ $ad->url }}" 
           class="d-block" 
           @if($ad->open_in_new_tab) target="_blank" @endif
           onclick="trackAdClick({{ $ad->id }})">
            <img src="{{ asset($ad->image_path) }}" 
                 alt="{{ $ad->image_alt ?? 'Advertisement' }}" 
                 class="img-fluid rounded w-100">
        </a>
    @elseif($ad->type == 'html')
        <div class="ad-html-content">{!! $ad->html_content !!}</div>
    @elseif($ad->type == 'script')
        <div class="ad-script-content">{!! $ad->html_content !!}</div>
    @endif
</div>
@endif