<div>
    <x-coderunner.code-editor />

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('codeRunner', () => ({
                editor: undefined,
                input: document.querySelector('#input'),
                init() {
                    this.editor = new EditorView({
                        extensions: [basicSetup, python()],
                        parent: document.querySelector('#editor'),
                    });

                    this.input.value = "{{$block->content['default_input']}}"

                    this.editor.dispatch({
                        changes: {
                            from: 0,
                            to: this.editor.state.doc.length,
                            insert: `{!!$block->content['default_code']!!}`,
                        }
                    })
                },
                run() {
                    let code = this.editor.state.doc.toString()
                    document.getElementById('codeToRun').value = code
                    document.getElementById('runButton').click()
                },
                tests: [
                  @foreach($block->children as $case)
                      {
                          input: "{{$case->content['input']}}",
                          output: "{{$case->content['output']}}"
                      },
                  @endforeach
                ],
                runTests() {
                    let code = this.editor.state.doc.toString()
                    document.getElementById('codeToRun').value = code
                    document.getElementById('tests').value = JSON.stringify(this.tests)
                    document.getElementById('runTestsButton').click()
                }
            }))
        })
    </script>
</div>
