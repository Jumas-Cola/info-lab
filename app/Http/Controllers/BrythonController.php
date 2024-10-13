<?php

namespace App\Http\Controllers;

class BrythonController extends Controller
{
    public function index()
    {
        $block = new class
        {
            public string $id = 'brython_interpreter';

            public string $default_input = '1000';

            public string $default_code = 'import sys


def sieve_of_eratosthenes(max_number):
    primes = [i for i in range(max_number + 1)]

    primes[1] = 0

    for i in range(2, max_number + 1):
        if primes[i] != 0:
            for j in range(i * 2, max_number + 1, i):
                primes[j] = 0

    primes = [i for i in primes if i != 0]

    return primes

max_number = int(sys.stdin.read())
primes = sieve_of_eratosthenes(max_number)
print(primes)
            ';

            public mixed $children = null;
        };

        $block->children = collect([]);

        return view('brython-interpreter', compact('block'));
    }
}
