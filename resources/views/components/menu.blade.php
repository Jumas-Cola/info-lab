<nav class="main-nav navbar navbar-expand-lg">
    <div class="container-fluid">
        <!-- ***** Logo Start ***** -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <span class="text-white fs-1 fw-bold">{{ $siteSettings->content['logo'] }}</span>
        </a>
        <!-- ***** Logo End ***** -->
        <!-- ***** Serach Start ***** -->
        <div class="search-input">
            <x-nav.search />
        </div>
        <!-- ***** Serach Start ***** -->
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse ms-auto" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a href="{{ route('home') }}"
                        class="text-white nav-link {{ Route::is('home') ? 'active' : '' }}">Главная</a>
                </li>
                <li class="nav-item"><a class="text-white nav-link" href="{{ route('labs') }}">Лабораторные работы</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="text-white nav-link dropdown-toggle {{ Route::is('calc.*') ? 'active' : '' }}"
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Калькуляторы
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item"><a class="text-dark" href="{{ route('calc.base-convert') }}">Перевод
                                системы
                                счисления</a></li>
                        <li class="dropdown-item"><a class="text-dark" href="{{ route('calc.turing-machine') }}">Машина
                                Тьюринга</a>
                        </li>
                        <li class="dropdown-item"><a class="text-dark" href="{{ route('calc.normal-algo') }}">Нормальные
                                алгоритмы</a></li>
                        <li class="dropdown-item"><a class="text-dark" href="{{ route('calc.game-of-life') }}">Игра
                                "Жизнь"</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="{{ route('pages') }}"
                        class="text-white nav-link {{ Route::is('pages') ? 'active' : '' }}">Статьи</a>
                </li>
                @foreach ($links as $link)
                    <li class="nav-item">
                        <a class="text-white nav-link"
                            href="{{ route('frontend.page', [$link->getRelated('page')->first()->slug]) }}">
                            {{ $link->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
