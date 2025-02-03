<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'a' => ['required','numeric'],
            'b' => ['required','numeric'],
            'o' => ['required','in:+,-,*,/'],
        ]);

        $a = $request->input('a');
        $b = $request->input('b');
        $o = $request->input('o');
        $hasil = 0;

        switch ($o) {
            case '+':
                $hasil = $a + $b;
                break;
            case '-':
                $hasil = $a - $b;
                break;
            case '*':
                $hasil = $a * $b;
                break;
            case '/':
                if ($b != 0){
                    $hasil = $a / $b;
                } else {
                    $hasil = 0;
                }
                break;
        }

        // dd(session()->all());
        return redirect()->route('calculator.index')->with('hasil',$hasil);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
