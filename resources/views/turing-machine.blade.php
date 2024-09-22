<x-main-layout>
    <div class="container mt-3">
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title text-center">Машина Тьюринга</h5>

                <div>
                    <p>
                        <span class="fw-bold">Машина Тьюринга</span> — это абстрактная математическая модель вычислений,
                        предложенная Аланом
                        Тьюрингом в
                        1936 году. Она позволяет формализовать понятие алгоритма и вычислимости. Машина состоит из
                        бесконечной ленты, разделённой на ячейки, и считывающей головки, которая может перемещаться по
                        ленте
                        влево или вправо, читать символы и записывать новые.
                    <p>Основные элементы машины Тьюринга:</p>
                    </p>
                    <p>
                    <ul>
                        <li>
                            <span class="fw-bold">Лента</span> — бесконечная последовательность ячеек, каждая из которых
                            может содержать один символ
                            из
                            конечного алфавита.
                        </li>
                        <li>
                            <span class="fw-bold">Головка</span> — устройство, которое может читать символ с текущей
                            позиции ленты и записывать на
                            эту же
                            позицию новый символ.
                        </li>
                        <li>
                            <span class="fw-bold">Множество состояний</span> — машина может находиться в одном из
                            конечного числа состояний.
                        </li>
                        <li>
                            <span class="fw-bold">Функция перехода</span> — определяет, какое действие машина выполнит в
                            зависимости от текущего
                            состояния и
                            символа на ленте.
                        </li>
                    </ul>
                    Действие может включать:
                    <ul>
                        <li>
                            Изменение символа в текущей ячейке.
                        </li>
                        <li>
                            Переход в новое состояние.
                        </li>
                        <li>
                            Перемещение головки на одну ячейку влево или вправо.
                        </li>
                        <li>
                            Начальное состояние — состояние, в котором машина начинает работу.
                        </li>
                        <li>
                            Конечное состояние — если машина попадает в это состояние, её работа завершается.
                        </li>
                    </ul </p>

                    <p>
                        Принцип работы:
                    </p>

                    На каждом шаге машина Тьюринга считывает символ с ленты, основываясь на текущем состоянии и этом
                    символе, выполняет одну из следующих операций:

                    <ul>
                        <li>
                            Записывает новый символ на ленту.
                        </li>
                        <li>

                            Переходит в другое состояние.
                        </li>
                        <li>

                            Сдвигает головку на одну позицию влево или вправо.
                        </li>
                        <li>

                            Этот процесс повторяется, пока машина не попадёт в специальное "завершающее" состояние.
                        </li>
                    </ul>


                    <p>
                        Примеры программ для машины Тьюринга:
                    </p>

                    <p class="fw-bold">
                        Пример: Инверсия битов
                    </p>

                    <p>
                        Эта программа инвертирует все биты на ленте (меняет 0 на 1 и 1 на 0).
                    </p>

                    <code>
                        <pre>
q1 0 -> q1 1 R 
q1 1 -> q1 0 R
q1 * -> qz * E
</pre>
                    </code>

                    <p>
                        Машина Тьюринга является мощной теоретической моделью, способной выполнять любые вычисления,
                        которые
                        можно выразить в виде алгоритма. Её универсальность позволяет использовать её как для решения
                        конкретных задач, так и для изучения пределов вычислимости.
                    </p>
                </div>

                <div class="row justify-content-center mt-2">
                    <label class="col-8" for="tape">Tape:</label>
                    <input class="col-8" type="text" id="tape" value="111*1111">
                    <label class="col-8 mt-2" for="program">Program:</label>
                    <textarea class="col-8" id="program" name="program" cols="30" rows="10">
q1 * -> qz 0 E
q1 1 -> q2 0 R
q2 1 -> q2 1 R
q2 * -> qz 1 E
        </textarea>

                    <div class="col-8 mt-2">
                        <button class="btn btn-success w-25" id="runBtn" type="button">Run</button>
                        <button class="btn btn-danger w-25" id="stopBtn" type="button">Stop</button>
                    </div>

                    <label class="col-8 mt-3" for="output">Output:</label>
                    <textarea class="col-8" id="output" name="output" cols="30" rows="10"></textarea>
                    <label class="col-8 mt-2" for="result">Result:</label>
                    <h4 class="col-8" id="result"></h4>
                </div>

            </div>
        </div>
    </div>

    <script>
        class TM {
            constructor() {
                this.state = "q1";
                this.pos = 0;
                this.tape = [];
                this.stop = false;
                this.timeout = 400;
            }

            stopSwitch() {
                this.stop = !this.stop;
            }

            printState() {
                output.value += this.state + ':' + ' '.repeat(this.pos) + 'V' + '\n';
                output.value += ' '.repeat(this.state.length) + ' ' + this.tape.join('') + '\n';
                output.scrollTop = output.scrollHeight;
            }

            runProgram() {
                if (this.state == 'qz') {
                    this.printState();
                    result.innerText = this.tape.join('').replace(/^0+|0+$/g, '');
                    return;
                } else if (this.stop) {
                    return;
                }
                if (this.tape.length == 0) {
                    this.tape.push('0');
                }
                this.printState();
                for (var line of this.programList) {
                    let [state_A, sign_A, , state_B, sign_B, shift] = line.split(' ');
                    if ((this.state == state_A) && (this.tape[this.pos] == sign_A)) {
                        this.state = state_B;

                        if (this.pos < 0) {
                            this.pos = 0;
                            this.tape.splice(0, 0, sign_B);
                        } else if (this.pos >= this.tape.length) {
                            this.tape.push(sign_B);
                        } else {
                            this.tape[this.pos] = sign_B;
                        }

                        if (shift == 'L') {
                            this.pos -= 1;
                        } else if (shift == 'R') {
                            this.pos += 1;
                        }

                        if (this.pos < 0) {
                            this.pos = 0;
                            this.tape.splice(0, 0, '0');
                        } else if (this.pos >= this.tape.length) {
                            this.tape.push('0');
                        }

                        break;
                    }

                }
                setTimeout(this.runProgram.bind(this), this.timeout);
            }

            execute(tape, program) {
                this.state = "q1";
                this.pos = 0;
                this.tape = [];
                this.stop = false;

                output.value = '';
                result.innerText = '';
                this.tape = tape.replace(/^0+|0+$/g, '').split('');
                var programList = [];
                for (var l of program.split('\n')) {
                    if (l.length > 0) {
                        programList.push(l.trim());
                    }
                };
                this.programList = programList;
                this.runProgram();

            }
        }

        var tm = new TM();
        runBtn.onclick = function() {
            tm.execute(document.querySelector('#tape').value,
                document.querySelector('#program').value);
        };
        stopBtn.onclick = function() {
            tm.stopSwitch();
        };
    </script>
</x-main-layout>
