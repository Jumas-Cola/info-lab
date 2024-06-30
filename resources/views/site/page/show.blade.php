<x-main-layout>
    <x-slot:title>
        {{ $page->title }}
    </x-slot>

    <x-slot:description>
        {{ $page->description }}
    </x-slot>

    <div class="container mt-4">
        <div class="w-100 me-5">
            <h1 class="mt-3">{{ $page->title }}</h1>

            {!! $page->renderBlocks() !!}
        </div>
    </div>
</x-main-layout>
