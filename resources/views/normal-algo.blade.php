<x-main-layout>
    <div class="container">
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title text-center">Машина Тьюринга</h5>

                <div class="row justify-content-center mt-2">
                    <label class="col-8" for="tape">Tape:</label>
                    <input class="col-8" type="text" id="tape" value="111*1111">
                    <label class="col-8 mt-2" for="program">Program:</label>
                    <textarea class="col-8" id="program" name="program" cols="30" rows="10">
1*1 -> *
*1  -> b
*   -> .1
b1  -> b
b   -> .1
        </textarea>

                    <div class="col-8 d-flex mt-2">
                        <button class="btn btn-success w-25" id="runBtn" type="button">Run</button>
                        <button class="btn btn-danger w-25 ms-1" id="stopBtn" type="button">Stop</button>
                        <div class="d-flex ms-1">
                            <label for="timeInterval">Скорость:</label>
                            <select class="form-select form-select-sm ms-1" name="timeInterval" id="timeInterval"
                                aria-label="Скорость">
                                <option value="0">0s</option>
                                <option value="400" selected="selected">0.4s</option>
                                <option value="600">0.6s</option>
                                <option value="800">0.8s</option>
                                <option value="1000">1s</option>
                            </select>
                        </div>
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
        class NA {
            constructor() {
                this.counter = 1;
                this.tape = '';
                this.stop = true;
                this.timeout = parseInt(timeInterval.value);
            }

            stopSwitch() {
                this.stop = !this.stop;
            }

            printState() {
                output.value += this.counter + '. ' + this.tape + '\n';
                this.counter++;
                output.scrollTop = output.scrollHeight;
            }

            printToOutput(outStr) {
                output.value += outStr + '\n';
                output.scrollTop = output.scrollHeight;
            }

            runProgram() {
                if (this.stop) {
                    return;
                }
                if (this.tape.length == 0) {
                    result.innerText = 'Tape is empty';
                    this.stop = true;
                    return;
                }
                this.printState();
                let match_instr = false;
                for (var instr of this.programList) {
                    let [from_instr, to_instr] = instr;
                    if (this.tape.includes(from_instr)) {
                        this.printToOutput(' '.repeat(('' + this.counter).length) + '  ' +
                            from_instr + ' -> ' + to_instr);
                        if (from_instr == '') {
                            this.tape = to_instr.replace('.', '') + this.tape;
                        } else {
                            this.tape = this.tape.replace(from_instr, to_instr.replace('.', ''));
                        }
                        if (to_instr[0] == '.') {
                            this.printState();
                            result.innerText = this.tape;
                            this.stop = true;
                            return;
                        }
                        match_instr = true;
                        break
                    }
                }
                if (!match_instr) {
                    result.innerText = 'Infinite loop';
                    this.stop = true;
                    return;
                }
                setTimeout(this.runProgram.bind(this), this.timeout);
            }

            execute(tape, program) {
                this.counter = 1;
                this.tape = [];
                this.stop = false;

                output.value = '';
                result.innerText = '';
                this.tape = tape.replace(/^0+|0+$/g, '');
                var programList = [];
                for (var l of program.split('\n')) {
                    if (l.length > 0) {
                        programList.push(l.replace(/\s/g, '').split('->'));
                    }
                };
                this.programList = programList;
                console.log(programList);
                this.runProgram();
            }
        }

        var na = new NA();
        runBtn.onclick = function() {
            if (na.stop) {
                console.log(1);
                na.execute(document.querySelector('#tape').value,
                    document.querySelector('#program').value);
            }
        };
        stopBtn.onclick = function() {
            na.stopSwitch();
        };
        timeInterval.onchange = function() {
            na.timeout = parseInt(timeInterval.value);
        }
    </script>
</x-main-layout>
