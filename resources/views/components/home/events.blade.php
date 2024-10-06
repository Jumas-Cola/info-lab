<div class="section events" id="events">
    @if ($siteSettings->children()->where('child_key', 'roadmap_items')->exists())
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-heading">
                        <h6>Roadmap</h6>
                        <h2>План развития проекта</h2>
                    </div>
                </div>
                <div>
                    @foreach ($siteSettings->children()->where('child_key', 'roadmap_items')->get() as $item)
                        <div class="col-lg-12 col-md-6">
                            <div class="item">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="image">

                                            @if (!Str::startswith($item->image('highlight', 'mobile'), 'data'))
                                                <img src="{{ $item->image('highlight', 'mobile') }}"
                                                    alt="{{ $item->content['title'] ?? '' }}">
                                            @else
                                                <img src="{{ Vite::asset('resources/images/event-0' . rand(1, 3) . '.jpg') }}"
                                                    alt="{{ $item->content['title'] ?? '' }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <ul>
                                            <li>
                                                <span class="category">{{ $item->content['badge'] ?? '' }}</span>
                                                <h4>{{ $item->content['title'] ?? '' }}</h4>
                                            </li>
                                            @if ($item->content['date'] ?? false)
                                                <li>
                                                    <span>Дата релиза:</span>
                                                    <h6>{{ \Carbon\Carbon::parse($item->content['date'])->format('d.m.Y') }}
                                                    </h6>
                                                </li>
                                            @endif
                                        </ul>
                                        @if ($item->getRelated('page')->first()->slug ?? false)
                                            <a href="/pages/{{ $item->getRelated('page')->first()->slug }}"><i
                                                    class="fa fa-angle-right"></i></a>
                                        @else
                                            <a href="#"></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
