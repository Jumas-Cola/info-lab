<x-main-layout>
    <style>
        .base-solution {
            position: absolute;
            padding: 2px 15px;
        }

        .ost {
            border: 1px solid green;
            padding: 0 5px 0 5px;
            margin-left: -5px;
            border-radius: 15px;
            -moz-border-radius: 15px;
            -webkit-border-radius: 15px;
            white-space: nowrap;
        }
    </style>
    <div class="container mt-3">
        <div x-data="toDecBase" class="card mt-2">
            <div class="card-body">
                <h5 class="card-title">Перевод числа в десятичную систему счисления</h5>
                <div class="container">
                    <div class="row">
                        <div class="col-3">
                            <div class="mb-3">
                                <label for="inputNum" class="form-label">Введите число</label>
                                <input type="number" class="form-control" id="inputNum" type="number" x-model="num">
                            </div>
                            <div class="mb-3">
                                <label for="inputBase" class="form-label">Введите начальное основание</label>
                                <input type="number" class="form-control" id="inputBase" type="number" x-model="base">
                            </div>
                            <button class="btn btn-primary btn-sm mt-2" type="button"
                                @click="changeBase">Перевести</button>
                            <div x-show="resArr.length > 0" class="mt-3">
                                <label for="inputRes" class="form-label">Ответ</label>
                                <input type="number" class="form-control" id="inputRes" type="number" x-model="res">
                                <div class="form-text">Остатки в обратном порядке</div>
                            </div>
                        </div>
                        <div class="offset-2 col">
                            <div id="resultBaseSwitch" class="fs-3" x-html="res">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div x-data="baseSwitch" class="card mt-2">
            <div class="card-body">
                <h5 class="card-title">Перевод числа в другую систему счисления</h5>
                <div class="container">
                    <div class="row">
                        <div class="col-3">
                            <div class="mb-3">
                                <label for="inputNum" class="form-label">Введите число</label>
                                <input type="number" class="form-control" id="inputNum" type="number" x-model="num">
                            </div>
                            <div class="mb-3">
                                <label for="inputBase" class="form-label">Введите основание</label>
                                <input type="number" class="form-control" id="inputBase" type="number" x-model="base">
                            </div>
                            <button class="btn btn-primary btn-sm mt-2" type="button"
                                @click="changeBase">Перевести</button>
                            <div x-show="resArr.length > 0" class="mt-3">
                                <label for="inputRes" class="form-label">Ответ</label>
                                <input type="text" class="form-control" id="inputRes" x-model="res">
                                <div class="form-text">Остатки в обратном порядке</div>
                            </div>
                        </div>
                        <div class="offset-2 col">
                            <div id="resultBaseSwitch" class="position-relative"
                                :style="`display: block;height: ${resArr.length*44}px;`">
                                <template x-for="step, n in resArr">
                                    <div>
                                        <div class="base-solution" :id="`step${n}`"
                                            :style="`left:${50 + 50*n}px; top:${31*n}px;`" x-text="step.num">
                                        </div>
                                        <div class="base-solution"
                                            :style="`left:${102 + 50*n}px; top:${31*n}px;border-left:1px solid black;border-bottom:1px solid black;`"
                                            x-text="currentBase">
                                        </div>
                                        <div class="base-solution" :id="`minus${n}`"
                                            :style="`left:${50 + 50*n}px; top:${31 + 31*n}px;`" x-text="step.minus">
                                        </div>
                                        <div class="base-solution"
                                            :style="`left:${50 + 50*n}px; top:${62 + 31*n}px;color:green;font-weight:bold;font-size:26px;text-align:right; width:22px;text-align:center;`">
                                            <span class="ost" x-text="step.ost"></span>
                                        </div>
                                    </div>
                                </template>
                                <div x-show="resArr.length > 0">
                                    <div class="base-solution" :id="`step${resArr.length}`"
                                        :style="`left:${50 + 50*resArr.length}px; top:${31*resArr.length}px;`"
                                        x-text="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const divmod = (x, y) => [Math.floor(x / y), x % y];

        document.addEventListener('alpine:init', () => {
            Alpine.data('toDecBase', () => ({
                num: 1000,
                base: 2,
                res: '',
                resArr: [],
                init() {
                    this.changeBase();
                },
                changeBase() {
                    if (this.base <= 1) {
                        return;
                    }
                    const res = document.getElementById('resultToDecBase');
                    this.res = '';
                    num = `${this.num}`
                    sum = 0

                    for (i = 0; i < num.length; i++) {
                        item = num[num.length - 1 - i]

                        if (i != 0) {
                            this.res = `${item} &#8226; ${this.base}<sup>${i}</sup> + ` + this.res
                        } else {
                            this.res = `${item} &#8226; ${this.base}<sup>${i}</sup>` + this.res
                        }

                        sum += +item * this.base ** i
                    }

                    this.res = this.res + ` = ${sum}`
                }
            }))

            Alpine.data('baseSwitch', () => ({
                num: 8,
                base: 2,
                currentBase: 2,
                res: '',
                resArr: [],
                transNums: {
                    10: 'A',
                    11: 'B',
                    12: 'C',
                    13: 'D',
                    14: 'E',
                    15: 'F',
                    16: 'G',
                    17: 'H',
                    18: 'I',
                    19: 'J',
                    20: 'K',
                    21: 'L',
                    22: 'M',
                    23: 'N',
                    24: 'O',
                    25: 'P',
                    26: 'Q',
                    27: 'R',
                    28: 'S',
                    29: 'T',
                    30: 'U',
                    31: 'V',
                    32: 'W',
                    33: 'X',
                    34: 'Y',
                    35: 'Z',
                },
                init() {
                    this.changeBase();
                },
                numToChar(num) {
                    if (num < 10 || this.transNums[num] == undefined) {
                        return num;
                    } else {
                        return this.transNums[num];
                    }
                },
                changeBase() {
                    if (this.base <= 1) {
                        return;
                    }
                    this.currentBase = this.base
                    const res = document.getElementById('resultBaseSwitch');
                    this.resArr = [];
                    this.res = '';
                    num = +this.num
                    while (num > this.base) {
                        divmodArr = divmod(num, this.base);
                        ost = divmodArr[1]
                        this.resArr.push({
                            num: num,
                            minus: divmodArr[0] * this.base,
                            ost: ost,
                        });
                        this.res = this.numToChar(ost) + this.res
                        num = divmodArr[0];
                    }

                    this.resArr.push({
                        num: num,
                        minus: 0,
                        ost: num % this.base,
                    });
                    this.res = this.numToChar(num % this.base) + this.res
                    if (num >= this.base) {
                        this.resArr.push({
                            num: num,
                            minus: 0,
                            ost: 1,
                        });
                        this.res = '1' + this.res
                    }
                }
            }))
        })
    </script>
</x-main-layout>
