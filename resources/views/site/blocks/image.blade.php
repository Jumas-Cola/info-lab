@php
    $imgArr = $block->imageAsArray('highlight', 'desktop');
@endphp

<div class="pt-6 m-auto d-flex align-items-center">
    <figure>
      <img src="{{ $imgArr['src'] }}" alt="{{ $imgArr['alt'] }}" />
      <figcaption>{{ $imgArr['caption'] }}</figcaption>
    </figure>
</div>
