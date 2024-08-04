<div>
    <script type="text/javascript" src="/build/assets/brython.min.js"></script>
    <script type="text/javascript" src="/build/assets/brython_stdlib.js"></script>
    @vite(['resources/js/codemirror.js'])

    <div class="mt-3" x-data="codeRunner_{{$block->id}}">
        <div class="fs-5">
            Напишите код здесь:
        </div>

        <div id="editor_{{$block->id}}">
        </div>

        <div class="row mt-3">
            <div class="col">
                <textarea class="form-control" id="input_{{$block->id}}" rows="5"></textarea>
            </div>
            <div class="col">
                <textarea class="form-control" id="output_{{$block->id}}" rows="5"></textarea>
            </div>
        </div>

        <button class="btn btn-primary mt-3" type="button" @click="run()">
            Запустить
        </button>

        @if ($block->children->count() > 0)
            <button class="btn btn-success mt-3" type="button" @click="runTests()">
                Запустить тесты
            </button>
        @endif

        <div class="mt-3 fs-5" id="testResult_{{$block->id}}">
        </div>
    </div>

    <div onload="brython()" class="d-none">
        <textarea id="codeToRun_{{$block->id}}" rows="0" cols="0">
        </textarea>
        <textarea id="tests_{{$block->id}}" rows="0" cols="0">
        </textarea>
        <script type="text/python">
            from browser import document, alert
            from io import StringIO
            import sys
            import json

            def run(event):
                sys.stdin = StringIO(document["input_{{$block->id}}"].value)
                stdout_buffer = StringIO()
                sys.stdout = stdout_buffer

                code = document["codeToRun_{{$block->id}}"].value
                output = document["output_{{$block->id}}"]
                try:
                    exec(code)
                except Exception as e:
                    output.value = f"Error: {e}"
                finally:
                    sys.stdout = sys.__stdout__

                output.value = stdout_buffer.getvalue()

            def run_tests(event):
                tests = json.loads(document["tests_{{$block->id}}"].value)
                output = document["output_{{$block->id}}"]
                test_result = document["testResult_{{$block->id}}"]

                i = 1
                for test in tests:
                    print('In:', test["input"], 'Out:', test["output"])

                    sys.stdin = StringIO(test["input"])
                    stdout_buffer = StringIO()
                    sys.stdout = stdout_buffer

                    code = document["codeToRun_{{$block->id}}"].value

                    try:
                        exec(code)
                    except Exception as e:
                        output.value = f"Error: {e}"
                    finally:
                        sys.stdout = sys.__stdout__

                    if stdout_buffer.getvalue().strip() != test["output"]:
                        test_result.setAttribute("class", "mt-3 fs-5 text-danger")
                        test_result.innerHTML = f"Тест {i} провален.<br> Ввод: '{test['input']}'<br> Ожидаемый вывод: '{test['output'].strip()}', имеется '{stdout_buffer.getvalue().strip()}'"
                        break
                    i += 1
                else:
                    test_result.setAttribute("class", "mt-3 fs-4 text-success")
                    test_result.innerHTML = "Все тесты пройдены!"

            document["runButton_{{$block->id}}"].bind("click", run)
            document["runTestsButton_{{$block->id}}"].bind("click", run_tests)
        </script>

        <button id="runButton_{{$block->id}}"></button>
        <button id="runTestsButton_{{$block->id}}"></button>
    </div>
</div>
