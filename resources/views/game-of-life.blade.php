<x-main-layout>
    <div class="container mt-3">
        <div class="card mt-2">
            <div x-data="gameOfLife" class="card-body">
                <h5 class="card-title text-center">Игра "Жизнь"</h5>

                <div>
                    <p>
                        Игра "Жизнь" (Conway's Game of Life) — это клеточный автомат, разработанный математиком Джоном
                        Конвеем в 1970 году. Игра "Жизнь" демонстрирует, как из простых правил могут возникать сложные и
                        непредсказуемые структуры. Она представляет собой двумерную сетку, где каждая клетка может быть
                        либо "живой", либо "мёртвой". Эволюция клеток происходит на основе определённых правил, которые
                        определяют, как клетка будет изменяться в зависимости от её соседей.
                    </p>

                    <p>
                        Принципы работы игры:
                    </p>

                    <ul>
                        <li>
                            <span class="fw-bold">Сетка</span> состоит из клеток, каждая из которых находится в одном из
                            двух состояний: "живая"
                            (заполненная) или "мёртвая" (пустая).
                        </li>
                        <li>
                            <span class="fw-bold">Поколения</span>: игра протекает в виде последовательных шагов
                            (поколений). На каждом шаге
                            состояние всех клеток обновляется одновременно.
                        </li>
                        <li>
                            <span class="fw-bold">Соседи клетки</span> — это 8 клеток, окружающих её со всех сторон:
                            сверху, снизу, слева, справа и
                            по диагоналям.
                        </li>
                    </ul>

                    Правила:

                    <ul>
                        <li>
                            <span class="fw-bold">Рождение</span>: если у мёртвой клетки есть ровно три живых соседа, то
                            она "оживает" в следующем поколении.
                        </li>
                        <li>
                            <span class="fw-bold">Выживание</span>: если у живой клетки два или три живых соседа, то она
                            остаётся живой.
                        </li>
                        <li>
                            <span class="fw-bold">Смерть от одиночества</span>: если у живой клетки меньше двух живых
                            соседей, она умирает от недостатка
                            взаимодействий.
                        </li>
                        <li>
                            <span class="fw-bold">Смерть от перенаселённости</span>: если у живой клетки больше трёх
                            живых соседей, она умирает из-за
                            перенаселённости.
                        </li>
                    </ul>

                    <p class="fs-4">Примеры фигур:</p>

                    <p class="fs-5 mt-3">Блок (Block)</p>

                    <p>
                        Это простая, стабильная структура из четырёх живых клеток, которая никогда не изменяется. Блок
                        не
                        имеет соседей, чтобы умереть или разделиться, поэтому он остаётся неизменным.
                    </p>

                    <table style="width: 50px">
                        <tr>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                        </tr>
                    </table>

                    <p class="fs-5 mt-3">Кораблик (Glider)</p>
                    <p>
                        Это подвижная структура, которая перемещается по сетке по диагонали. Кораблик — одна из самых
                        известных фигур в "Жизни". Каждые несколько шагов его форма меняется, но он продолжает двигаться
                        в одном направлении.
                    </p>

                    <table style="width: 75px">
                        <tr>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                        </tr>
                    </table>

                    <p class="fs-5 mt-3">Пульсар (Pulsar)</p>
                    <p>
                        Это осциллирующая структура, которая колеблется в периоде 3 (меняет свою форму каждые три
                        поколения). Пульсар — один из самых известных осцилляторов, состоящий из большого количества
                        клеток.
                    </p>

                    <table style="width: 275px">
                        <tr>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                        </tr>
                    </table>

                    <p class="fs-5 mt-3">Маяк (Beacon)</p>
                    <p>
                        Это ещё один осциллятор с периодом 2, состоящий из двух "блоков", которые колеблются, увеличивая
                        и уменьшая своё пространство в зависимости от поколения.
                    </p>

                    <table style="width: 100px">
                        <tr>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                            <td>
                                <div class="content bg-primary"></div>
                            </td>
                        </tr>
                    </table>

                    <p class="mt-3">
                        Игра "Жизнь" интересна своей простотой и одновременно возможностью моделировать сложные
                        динамические
                        системы. Несмотря на то что правила крайне просты, на практике они приводят к возникновению
                        сложных
                        и даже хаотических узоров. Игра Конвея наглядно демонстрирует, как из локальных взаимодействий
                        могут
                        появляться глобальные структуры и поведение.
                    </p>
                </div>

                <div class="row justify-content-center mt-5">
                    <table class="col-md-8">
                        <template x-for="(row, rowIndex) in field">
                            <tr>
                                <template x-for="(cell, colIndex) in row">
                                    <td>
                                        <div @click="toggleCell(rowIndex, colIndex)" class="content"
                                            :style="{ 'background-color': cell ? '#0D6EFD' : '#f2f2f2' }"></div>
                                    </td>
                                </template>
                            </tr>
                        </template>
                    </table>

                    <div class="mt-4">
                        <div class="w-100 d-flex justify-content-center">
                            <button class="btn btn-success w-25 ms-1" id="runBtn" type="button"
                                @click="run">Запуск</button>
                            <button class="btn btn-info w-25 ms-1" id="stepBtn" type="button"
                                @click="step">Шаг</button>
                            <button class="btn btn-danger w-25 ms-1" id="stopBtn" type="button"
                                @click="stop = true">Стоп</button>
                            <button class="btn btn-warning w-25 ms-1" id="clearBtn" type="button"
                                @click="clearField">Очистить</button>
                        </div>
                        <div class="w-100 d-flex justify-content-center mt-2">
                            <div class="w-75">
                                <label for="fieldSize" class="form-label">Размер поля: <span x-text="fieldSize"
                                        class="fw-bold"></span></label>
                                <input type="range" class="form-range" id="fieldSize" value="10"
                                    min="5" max="50" @change="resizeField">
                            </div>
                        </div>
                        <div class="w-100 d-flex justify-content-center mt-2">
                            <div class="w-75">
                                <label for="stepTime" class="form-label">Скорость:</label>
                                <input type="range" class="form-range" id="stepTime" value="900"
                                    min="10" max="1000" @change="changeStepTime">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('gameOfLife', () => ({
                field: [
                    [],
                ],
                fieldSize: 10,
                stepTime: 100,
                init() {
                    this.resizeField({
                        target: {
                            value: 10,
                        }
                    });
                },
                clearField() {
                    this.field = Array.from({
                        length: this.fieldSize
                    }, () => Array.from({
                        length: this.fieldSize
                    }, () => 0));
                },
                changeStepTime(e) {
                    this.stepTime = 1000 - parseInt(e.target.value);
                    clearInterval(this.timer);
                    this.run();
                },
                resizeField(e) {
                    const fieldSize = parseInt(e.target.value);
                    this.field = Array.from({
                        length: fieldSize
                    }, () => Array.from({
                        length: fieldSize
                    }, () => Math.random() > 0.5 ? 1 : 0));
                    this.fieldSize = fieldSize;
                },
                toggleCell(rowIndex, colIndex) {
                    this.field[rowIndex][colIndex] = this.field[rowIndex][colIndex] === 0 ? 1 : 0;
                },
                step() {
                    let fieldsDifferent = false;
                    let newField = this.field.map(row => row.map(cell => cell));
                    for (let i = 0; i < this.fieldSize; i++) {
                        for (let j = 0; j < this.fieldSize; j++) {
                            const startI = i - 1 >= 0 ? i - 1 : i;
                            const startJ = j - 1 >= 0 ? j - 1 : j;
                            const endI = i + 1 < this.fieldSize ? i + 1 : i;
                            const endJ = j + 1 < this.fieldSize ? j + 1 : j;
                            let countAliveNeighbours = 0;
                            for (let k = startI; k <= endI; k++) {
                                for (let l = startJ; l <= endJ; l++) {
                                    if (!(k == i && l == j) && this.field[k][l] === 1) {
                                        countAliveNeighbours++;
                                    }
                                }
                            }
                            if (this.field[i][j] === 0) {
                                if (countAliveNeighbours == 3) {
                                    newField[i][j] = 1;
                                }
                            } else if (this.field[i][j] === 1) {
                                if (countAliveNeighbours == 3 || countAliveNeighbours == 2) {
                                    newField[i][j] = 1;
                                } else {
                                    newField[i][j] = 0;
                                }
                            }

                            fieldsDifferent = fieldsDifferent || newField[i][j] !== this.field[i][j];
                        }
                    }
                    if (!fieldsDifferent) {
                        this.stop = true;
                    }
                    this.field = newField;
                },
                run() {
                    this.stop = false;
                    this.step();
                    this.timer = setInterval(() => {
                        if (!this.stop) {
                            this.step();
                        } else {
                            clearInterval(this.timer);
                        }
                    }, this.stepTime);
                },
            }));
        });
    </script>

    <style>
        table,
        td {
            border: solid 1px #222 !important;
            border-collapse: collapse;
            width: 90%;
        }

        td {
            width: 1px;
            position: relative;
        }

        td .content {
            aspect-ratio: 1 / 1;
        }
    </style>
</x-main-layout>
