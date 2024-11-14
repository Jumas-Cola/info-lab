<x-main-layout>
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/simulator/simstyle.css') }}">
    <!-- Simulator stuff -->
    <script type="module" src="{{ Vite::asset('resources/js/simulator/simulator.js') }}"></script>

    <div class="p-5">
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md bg-body-tertiary">
            <span class="navbar-brand text-center p-1">
                Симулятор логических схем
            </span>
            <button class="navbar-toggler bg-secondary" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <div class="navGroupTools">
                            <button type="button" class="btn btn-light active" tool="Edit"
                                onclick="activeTool(this)">
                                <i class="fa fa-edit"></i>
                                Редактировать
                            </button>
                            <button type="button" class="btn btn-light" tool="Move" onclick="activeTool(this)">
                                <i class="fa fa-arrows"></i>
                                Переместить
                            </button>
                            <button type="button" class="btn btn-light" tool="Delete" onclick="activeTool(this)"">
                                <i class=" fa fa-trash-o"></i>
                                Удалить
                            </button>
                        </div>
                        <div class="navGroupTools">
                            <label type="button" class="btn btn-light" style="margin:0px">
                                <input id="projectFile" type="file"></input>
                                <i class="fa fa-upload"></i>
                                Загрузить
                            </label>
                            <a download="LogicCircuit00" href="#" id="saveProjectFile">
                                <button type="button" class="btn btn-light">
                                    <i class="fa fa-save"></i>
                                    Сохранить
                                </button>
                            </a>
                        </div>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Begin page content -->

        <div class="container-fluid pt-3">
            <div class="row">
                <div class="tools col overflow-scroll" style="overflow-y: scroll;height: calc(100vh - 5rem);">
                    <div class="list-group float-right" style="min-width: 50px; max-width: 60px">
                        <button type="button" tool="LogicInput" title="Logic Input" onclick="activeTool(this)"
                            class="list-group-item list-group-item-action pl-1">
                            ВХОД
                            <img src="{{ Vite::asset('resources/images/simulator/LogicInput.svg') }}" class="ml-2"
                                width="32">
                        </button>
                        <button type="button" tool="LogicOutput" title="Logic Output" onclick="activeTool(this)"
                            class="list-group-item list-group-item-action pl-1">
                            ВЫХОД
                            <img src="{{ Vite::asset('resources/images/simulator/LogicOutput.svg') }}" class="ml-2"
                                width="32">
                        </button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#ClockSettings"title="Clock"
                            class="list-group-item list-group-item-action pl-1">
                            ТАЙМЕР
                            <img src="{{ Vite::asset('resources/images/simulator/Clock.svg') }}" width="50">
                        </button>
                        <button type="button" tool="NOT" title="НЕ" isGate="true" onclick="activeTool(this)"
                            class="text-center list-group-item list-group-item-action pl-1">
                            НЕ
                            <img src="{{ Vite::asset('resources/images/simulator/NOT.svg') }}" width="50">
                        </button>
                        <button type="button" tool="AND" title="И" isGate="true" onclick="activeTool(this)"
                            class="text-center list-group-item list-group-item-action pl-1">
                            И
                            <img src="{{ Vite::asset('resources/images/simulator/AND.svg') }}" width="50">
                        </button>
                        <button type="button" tool="NAND" isGate="true" onclick="activeTool(this)"
                            class="list-group-item list-group-item-action pl-1">
                            НЕ И
                            <img src="{{ Vite::asset('resources/images/simulator/NAND.svg') }}" width="50">
                        </button>
                        <button type="button" tool="OR" isGate="true" onclick="activeTool(this)"
                            class="list-group-item list-group-item-action pl-1">
                            ИЛИ
                            <img src="{{ Vite::asset('resources/images/simulator/OR.svg') }}" width="50">
                        </button>
                        <button type="button" tool="NOR" isGate="true" onclick="activeTool(this)"
                            class="list-group-item list-group-item-action pl-1">
                            НЕ ИЛИ
                            <img src="{{ Vite::asset('resources/images/simulator/NOR.svg') }}" width="50">
                        </button>
                        <button type="button" tool="XOR" isGate="true" onclick="activeTool(this)"
                            class="list-group-item list-group-item-action pl-1">
                            ИСКЛЮЧАЮЩЕ ИЛИ
                            <img src="{{ Vite::asset('resources/images/simulator/XOR.svg') }}" width="50">
                        </button>
                        <button type="button" tool="XNOR" isGate="true" onclick="activeTool(this)"
                            class="list-group-item list-group-item-action pl-1">
                            ИСКЛЮЧАЮЩЕ НЕ ИЛИ
                            <img src="{{ Vite::asset('resources/images/simulator/XNOR.svg') }}" width="50">
                        </button>
                    </div>
                </div>
                <div class="col-10">
                    <!-- Simulator Canvas -->
                    <div id="canvas-sim"></div>
                </div>
            </div>
        </div>

        <div class="mt-3">
            Источник: <a href="https://github.com/drendog/Logic-Circuit-Simulator"
                target="_blank">github.com/drendog/Logic-Circuit-Simulator</a>
        </div>
    </div>

    <!-- Modal for Clock Settings -->
    <div class="modal fade" id="ClockSettings" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Настройки таймера</h5>
                </div>
                <div class="modal-body">
                    <h6>Период таймера</h6>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control period" value="1000" min="0">
                        <div class="input-group-append">
                            <span class="input-group-text">ms</span>
                        </div>
                    </div>
                    <h6>Доля пропускания</h6>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control duty-cycle" value="50" min="0"
                            max="100">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" tool="Clock" onclick="activeTool(this)"
                        data-bs-dismiss="modal">Создать</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal for Clock Settings-->

</x-main-layout>
