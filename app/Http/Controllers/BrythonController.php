<?php

namespace App\Http\Controllers;

class BrythonController extends Controller
{
    public function index()
    {
        $block = new class
        {
            public string $id = 'brython_interpreter';

            public string $default_input = 'Hello, World!';

            public string $default_code = 'import sys\n\n\nprint(sys.stdin.read())\n';

            public mixed $children = null;
        };

        $block->children = collect([]);

        return view('brython-interpreter', compact('block'));
    }
}
