<div>
    <x-coderunner.code-editor :block="$block" />

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

                    this.input.value = `{{$block->input('default_input')}}`

                    this.editor.dispatch({
                        changes: {
                            from: 0,
                            to: this.editor.state.doc.length,
                            insert: `{!!$block->input('default_code')!!}`,
                        }
                    })
                },
                run() {
                    let code = this.editor.state.doc.toString()
                    document.getElementById('codeToRun_{{$block->id}}').value = code
                    document.getElementById('runButton_{{$block->id}}').click()
                },
                tests: [
                  @foreach($block->children as $case)
                      {
                          input: `{{$case->content['input'] ?? ''}}`,
                          output: `{{$case->content['output'] ?? ''}}`
                      },
                  @endforeach
                ],
                runTests() {
                    let code = this.editor.state.doc.toString()
                    document.getElementById('codeToRun_{{$block->id}}').value = code
                    document.getElementById('tests_{{$block->id}}').value = JSON.stringify(this.tests)
                    document.getElementById('runTestsButton_{{$block->id}}').click()
                }
            }))
        })
    </script>
</div>
