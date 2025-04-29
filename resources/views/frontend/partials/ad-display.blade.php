@if(isset($ad))
    <div class="container" data-ad-id="{{ $ad->id }}" data-position="{{ $position ?? 'unknown' }}">
        @if($ad->type == 'image')
            <a href="{{ $ad->url }}" 
               class="d-block" 
               @if($ad->open_in_new_tab) target="_blank" @endif
               onclick="trackAdClick({{ $ad->id }})">
                <img src="{{ url($ad->image_path) }}" 
                     alt="{{ $ad->image_alt ?? 'Advertisement' }}" 
                     class="img-fluid rounded w-100">
            </a>
        @elseif($ad->type == 'html')
            <div class="ad-html-content">{!! $ad->html_content !!}</div>
        @elseif($ad->type == 'script')
            <div class="ad-script-content">{!! $ad->html_content !!}</div>
        @endif
    </div>
@elseif(isset($position))
    @php
        $ad = app(\App\Repositories\Ad\AdInterface::class)->getAdForPosition($position);
        if ($ad) {
            app(\App\Repositories\Ad\AdInterface::class)->recordImpression($ad);
        }
    @endphp
    
    @if($ad)
        <div class="container" data-ad-id="{{ $ad->id }}" data-position="{{ $position }}">
            @if($ad->type == 'image')
                <a href="{{ $ad->url }}" 
                   class="d-block" 
                   @if($ad->open_in_new_tab) target="_blank" @endif
                   onclick="trackAdClick({{ $ad->id }})">
                    <img src="{{ url($ad->image_path) }}" 
                         alt="{{ $ad->image_alt ?? 'Advertisement' }}" 
                         class="img-fluid rounded w-100 ">
                </a>
            @elseif($ad->type == 'html')
                <div class="ad-html-content">{!! $ad->html_content !!}</div>
            @elseif($ad->type == 'script')
                <div class="ad-script-content">{!! $ad->html_content !!}</div>
            @endif
        </div>
    @endif
@endif