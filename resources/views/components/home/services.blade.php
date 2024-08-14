<div class="services section" id="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="service-item">
                    <div class="icon">
                        <img src="{{ Vite::asset('resources/images/service-01.png') }}" alt="online degrees">
                    </div>
                    <div class="main-content">
                        <h4>Полезные статьи</h4>
                        <p>Полезные статьи по информатике, программированию, технологиях и т.д.</p>
                        <div class="main-button">
                            <a href="{{ route('pages') }}">Перейти</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-item">
                    <div class="icon">
                        <img src="{{ Vite::asset('resources/images/service-02.png') }}" alt="short courses">
                    </div>
                    <div class="main-content">
                        <h4>Лабораторные работы</h4>
                        <p>Лабораторные работы, которые можно выполнять прямо в браузере.</p>
                        <div class="main-button">
                            <a href="{{ route('labs') }}">Перейти</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-item">
                    <div class="icon">
                        <img src="{{ Vite::asset('resources/images/service-03.png') }}" alt="web experts">
                    </div>
                    <div class="main-content">
                        <h4>Онлайн калькуляторы</h4>
                        <p>Онлайн калькуляторы на разные случаи жизни.</p>
                        <div class="main-button">
                            <a href="{{ route('calc.base-convert') }}">Перейти</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
