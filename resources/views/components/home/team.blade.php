<div class="team section" id="team">
    <div class="container">
        <div class="d-flex justify-content-center">
            @foreach ($siteSettings->children()->where('child_key', 'site_faces')->get() as $face)
                <div class="ms-3 col-lg-3 col-md-6">
                    <div class="team-member">
                        <div class="main-content">
                            @if (!Str::startswith($face->image('highlight', 'mobile'), 'data'))
                                <img src="{{ $face->image('highlight', 'mobile') }}" alt="{{ $face->content['name'] }}">
                            @else
                                <img src="{{ Vite::asset('resources/images/placeholder.jpg') }}"
                                    alt="{{ $face->content['name'] }}">
                            @endif
                            <span class="category">{{ $face->content['job_title'] }}</span>
                            <h4>{{ $face->content['name'] }}</h4>
                            <div class="d-flex justify-content-center">
                                <div class="social-icons row w-75">
                                    @if (array_key_exists('github', $face->content) and $face->content['github'])
                                        <div class="col"><a href="{{ $face->content['github'] }}"><i
                                                    class="fab fa-github"></i></a></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
