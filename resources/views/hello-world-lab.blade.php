<x-main-layout>
    <script type="text/javascript" src="/build/assets/brython.min.js"></script>
    <div class="container mt-3">
        <div onload="brython()" class="card mt-2">
            <code>
                <pre>
                def fib(n):
                    n = int(n)
                    if n == 1:
                        return 1
                    elif n == 1:
                        return 1
                    else:
                        return fib(n-1) + fib(n-2)
                </pre>
            </code>

            <script type="text/python">
            from browser import document, alert

            def echo(event):
                alert(fib(document["zone"].value))

            def fib(n):
                n = int(n)
                if n == 1:
                    return 1
                elif n == 2:
                    return 1
                else:
                    return fib(n-1) + fib(n-2)

            document["mybutton"].bind("click", echo)
            </script>

            <input id="zone"><button id="mybutton">click !</button>

        </div>
    </div>
</x-main-layout>
