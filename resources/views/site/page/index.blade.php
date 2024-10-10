<x-main-layout>
    <x-slot:title>
        {{ __('Блог') }}
    </x-slot>

    <x-slot:description>
        {{ __('Блог сайта ИНФОЛАБ') }}
    </x-slot>


    <div class="container mt-5">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-3">
            @foreach ($pages as $page)
                <div class="col">
                    <a href="{{ route('frontend.page', ['slug' => $page->getActiveSlug()['slug']]) }}" type="button">
                        <div class="card shadow-sm">
                            <img class="card-img-top" width="100%" height="225"
                                src="{{ Str::startswith($page->image('cover'), 'data:') ? Vite::asset('resources/images/placeholder-02.jpg') : $page->image('cover') }}" />
                            <div class="card-body">
                                <p class="fs-4">{{ $page->title }}</p>
                                <p class="card-text">{{ Str::limit(strip_tags($page->renderBlocks())) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                    </div>
                                    <small
                                        class="text-body-secondary">{{ $page->created_at->translatedFormat('d M Y') }}</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        {{ $pages->links() }}
    </div>
</x-main-layout>
