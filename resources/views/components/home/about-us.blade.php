<div class="section about-us">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-1">
                <div class="accordion" id="accordionQuestions">
                    @foreach ($siteSettings->children()->where('child_key', 'homepage_question')->get() as $question)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $loop->index }}">
                                <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}"
                                    aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                    aria-controls="collapse{{ $loop->index }}">
                                    {{ $question->content['question'] }}
                                </button>
                            </h2>
                            <div id="collapse{{ $loop->index }}"
                                class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#accordionQuestions">
                                <div class="accordion-body">
                                    {!! $question->content['answer'] !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-5 align-self-center">
                <div class="section-heading">
                    <h6>О сайте</h6>
                    <h2>Хотите узнать больше о нас?</h2>
                    <p>Чтобы узнать больше, посетите страницу "О нас".</p>
                    <div class="main-button">
                        <a href="{{ route('about') }}">Подробнее</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
