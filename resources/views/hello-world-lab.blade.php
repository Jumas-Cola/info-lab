<x-main-layout>
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

                    this.input.value = 'Name'

                    this.editor.dispatch({
                        changes: {
                            from: 0,
                            to: this.editor.state.doc.length,
                            insert: `import sys

def hello_world(name):
  print(...)

hello_world(sys.stdin.read())
                            `,
                        }
                    })
                },
                run() {
                    let code = this.editor.state.doc.toString()
                    document.getElementById('codeToRun').value = code
                    document.getElementById('runButton').click()
                },
                tests: [{
                        input: 'John',
                        output: 'Hello John'
                    },
                    {
                        input: 'Van',
                        output: 'Hello Van'
                    },
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
</x-main-layout>
