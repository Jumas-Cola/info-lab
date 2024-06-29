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
    <div class="container">
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
                                <input type="number" class="form-control" id="inputRes" type="number" x-model="res">
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
                                            x-text="base">
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
                num: 0,
                base: 0,
                res: '',
                changeBase() {
                    if (this.base <= 0) {
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
                num: 0,
                base: 0,
                res: '',
                resArr: [],
                changeBase() {
                    if (this.base <= 0) {
                        return;
                    }
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
                        this.res = ost + this.res
                        num = divmodArr[0];
                    }

                    this.resArr.push({
                        num: num,
                        minus: 0,
                        ost: num % this.base,
                    });
                    this.res = num % this.base + this.res
                    if (num >= this.base) {
                        this.resArr.push({
                            num: num,
                            minus: 0,
                            ost: 1,
                        });
                        this.res = '1' + this.res
                    }
                    console.log(this.resArr);
                }
            }))
        })
    </script>
</x-main-layout>
