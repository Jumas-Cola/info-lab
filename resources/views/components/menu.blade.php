<nav class="main-nav">
    <!-- ***** Logo Start ***** -->
    <a href="{{ route('home') }}" class="logo">
        <h1>{{ $siteSettings['logo'] }}</h1>
    </a>
    <!-- ***** Logo End ***** -->
    <!-- ***** Serach Start ***** -->
    <div class="search-input">
        <form id="search" action="#">
            <input type="text" placeholder="Type Something" id='searchText' name="searchKeyword" onkeypress="handle" />
            <i class="fa fa-search"></i>
        </form>
    </div>
    <!-- ***** Serach Start ***** -->
    <!-- ***** Menu Start ***** -->
    <ul class="nav">
        <li class="nav-item"><a href="{{ route('home') }}" class="{{ Route::is('home') ? 'active' : '' }}">Главная</a>
        </li>
        <li class="nav-item"><a href="{{ route('labs') }}">Лабораторные работы</a></li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center {{ Route::is('calc.*') ? 'active' : '' }}"
                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Калькуляторы
            </a>
            <ul class="dropdown-menu">
                <li class="dropdown-item"><a class="text-dark" href="{{ route('calc.base-convert') }}">Перевод системы
                        счисления</a></li>
                <li class="dropdown-item"><a class="text-dark" href="{{ route('calc.turing-machine') }}">Машина
                        Тьюринга</a>
                </li>
                <li class="dropdown-item"><a class="text-dark" href="{{ route('calc.normal-algo') }}">Нормальные
                        алгоритмы</a></li>
            </ul>
        </li>
        <li class="nav-item"><a href="{{ route('pages') }}" class="{{ Route::is('pages') ? 'active' : '' }}">Блог</a>
        </li>
        @foreach ($links as $link)
            <li class="nav-item">
                <a href="{{ route('frontend.page', [$link->getRelated('page')->first()->slug]) }}">
                    {{ $link->title }}
                </a>
            </li>
        @endforeach
    </ul>
    <a class='menu-trigger'>
        <span>Menu</span>
    </a>
    <!-- ***** Menu End ***** -->
</nav>
