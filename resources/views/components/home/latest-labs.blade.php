<section class="section courses" id="courses">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="section-heading">
                    <h6>Новые</h6>
                    <h2>Лабораторные работы</h2>
                </div>
            </div>
        </div>
        <!--<ul class="event_filter">-->
        <!--    <li>-->
        <!--        <a class="is_active" href="#!" data-filter="*">Show All</a>-->
        <!--    </li>-->
        <!--    <li>-->
        <!--        <a href="#!" data-filter=".design">Webdesign</a>-->
        <!--    </li>-->
        <!--    <li>-->
        <!--        <a href="#!" data-filter=".development">Development</a>-->
        <!--    </li>-->
        <!--    <li>-->
        <!--        <a href="#!" data-filter=".wordpress">Wordpress</a>-->
        <!--    </li>-->
        <!--</ul>-->
        <div class="row event_box">
            @foreach ($latestLabs as $lab)
                <div class="col-lg-4 col-md-6 align-self-center mb-30 event_outer col-md-6 design">
                    <div class="events_item">
                        <div class="thumb">
                            <a href="{{ route('frontend.page', ['slug' => $lab->getNestedSlug()]) }}">
                                <img src="{{ $lab->image('cover') }}" alt="">
                            </a>
                            <span class="category">Python</span>
                            <span class="price">
                                <h6>New</h6>
                            </span>
                        </div>
                        <div class="down-content">
                            <span class="author">{{ $lab->created_at->format('d.m.Y') }}</span>
                            <h4>{{ $lab->title }}</h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
