<img{!! $attributeString !!} @if ($loadingAttributeValue) loading="{{ $loadingAttributeValue }}" @endif
    srcset="{{ $media->getSrcset($conversion) }}"
    onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});"
    sizes="50px" src="{{ $media->getUrl($conversion) }}" width="{{ $width }}" height="{{ $height }}"
    class="w-full h-full object-cover">
