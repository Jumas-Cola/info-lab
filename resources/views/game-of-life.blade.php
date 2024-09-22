<x-main-layout>
    <div class="container mt-3">
        <div class="card mt-2">
            <div x-data="gameOfLife" class="card-body">
                <h5 class="card-title text-center">Игра "Жизнь"</h5>

                <div class="row justify-content-center mt-2">
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
                                <input type="range" class="form-range" id="fieldSize" value="10" min="5"
                                    max="50" @change="resizeField">
                            </div>
                        </div>
                        <div class="w-100 d-flex justify-content-center mt-2">
                            <div class="w-75">
                                <label for="stepTime" class="form-label">Скорость:</label>
                                <input type="range" class="form-range" id="stepTime" value="900" min="10"
                                    max="1000" @change="changeStepTime">
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
            background: gold;
        }
    </style>
</x-main-layout>
