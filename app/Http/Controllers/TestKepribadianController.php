<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestKepribadianController extends Controller
{
    public function submitPersonalityTest(Request $request)
    {
        // Logika untuk memproses jawaban
        // Misalnya, menyimpan jawaban ke database atau melakukan kalkulasi

        // Redirect ke halaman hasil dengan data yang relevan
        return redirect()->route('personality.test.results');
    }
}
