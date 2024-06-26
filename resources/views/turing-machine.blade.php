<x-main-layout>
    <div class="container mt-3">
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title text-center">Машина Тьюринга</h5>


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
