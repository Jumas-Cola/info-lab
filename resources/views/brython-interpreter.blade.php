<x-main-layout>
    <div class="container mt-3">
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title">Интерпретатор Python</h5>
                <div class="container">
                    <x-coderunner.code-editor :block="$block"/>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('codeRunner_{{$block->id}}', () => ({
                editor: undefined,
                input: document.querySelector('#input_{{$block->id}}'),
                init() {
                    this.editor = new EditorView({
                        extensions: [basicSetup, python()],
                        parent: document.querySelector('#editor_{{$block->id}}'),
                    });

                    this.input.value = `{{$block->default_input}}`

                    this.editor.dispatch({
                        changes: {
                            from: 0,
                            to: this.editor.state.doc.length,
                            insert: `{!!$block->default_code!!}`,
                        }
                    })
                },
                run() {
                    let code = this.editor.state.doc.toString()
                    document.getElementById('codeToRun_{{$block->id}}').value = code
                    document.getElementById('runButton_{{$block->id}}').click()
                },
                runTests() {
                    let code = this.editor.state.doc.toString()
                    document.getElementById('codeToRun_{{$block->id}}').value = code
                    document.getElementById('runTestsButton_{{$block->id}}').click()
                }
            }))
        })
    </script>

</x-main-layout>
