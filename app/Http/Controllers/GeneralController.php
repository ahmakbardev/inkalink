<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
    public function searchUniv(Request $request)
    {
        $query = $request->input('query');

        $results = DB::table('universities')
            ->where('nama_universitas', 'LIKE', "%{$query}%")
            ->orWhere('nama_jurusan', 'LIKE', "%{$query}%")
            ->select('nama_universitas', 'nama_jurusan', 'nilai_rnm', 'url_info_pendaftaran', 'url_info_passinggrade', 'url_biaya_pendidikan')
            ->get()
            ->map(function ($item) {
                return [
                    'university' => $item->nama_universitas,
                    'major' => $item->nama_jurusan,
                    'score' => $item->nilai_rnm,
                    'url_pendaftaran' => $item->url_info_pendaftaran,
                    'url_passinggrade' => $item->url_info_passinggrade,
                    'url_biaya' => $item->url_biaya_pendidikan,
                ];
            });

        return response()->json($results);
    }
}
