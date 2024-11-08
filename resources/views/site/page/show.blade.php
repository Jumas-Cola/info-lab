<x-main-layout>
    <x-slot:title>
        {{ $page->title }}
    </x-slot>

    <x-slot:description>
        {{ $page->description }}
    </x-slot>

    @if (!Str::startsWith($page->image('cover'), 'data'))
        <div class="cover d-flex" style="background-image: url({{ $page->image('cover') }})">
            <div class="overlay d-flex">
                <div class="container d-flex align-items-end">
                    <h1 class="text-white fw-bold mb-2 mb-md-5">{{ $page->title }}</h1>
                </div>
            </div>
        </div>
    @endif

    <div class="container mt-4">
        <div class="w-100 me-5">
            @foreach ($page->tags as $tag)
                <span class="badge text-bg-primary">{{ $tag->name }}</span>
            @endforeach


            <div class="mt-3 mt-md-5">
                {!! $page->renderBlocks() !!}
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-3">
            @foreach ($page->children as $child)
                <div class="col">
                    <a class="w-100" href="{{ route('frontend.page', ['slug' => $child->getNestedSlug()]) }}"
                        type="button">
                        <div class="card shadow-sm">
                            <img class="card-img-top" width="100%" height="225"
                                src="{{ Str::startswith($child->image('cover'), 'data:') ? Vite::asset('resources/images/placeholder-02.jpg') : $child->image('cover') }}" />
                            <div class="card-body">
                                <p class="fs-4">{{ $child->title }}</p>
                                <p class="card-text">{{ Str::limit(strip_tags($child->renderBlocks())) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                    </div>
                                    <small
                                        class="text-body-secondary">{{ $child->created_at->translatedFormat('d M Y') }}</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        window.addEventListener('load', () => {
            const codes = document.querySelectorAll('code');
            for (let code of codes) {
                var codeNew = document.createElement('code');
                codeNew.className = 'language-python';
                var pre = document.createElement('pre');
                codeNew.textContent = code.textContent;

                pre.appendChild(codeNew);
                code.parentNode.replaceChild(pre, code);
            }
            hljs.highlightAll();
        })
    </script>
</x-main-layout>
