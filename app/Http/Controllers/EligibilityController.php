<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EligibilityController extends Controller
{
    public function input()
    {
        return view('cek-eligibilitas.input');
    }

    public function checkEligibility(Request $request)
    {
        // Extract grades from the request
        $grades = $request->input('grades');

        // Calculate the overall average
        $totalGrades = 0;
        $count = 0;

        foreach ($grades as $semester) {
            foreach ($semester as $grade) {
                $totalGrades += $grade;
                $count++;
            }
        }

        $overallAverage = $count > 0 ? ($totalGrades / $count) : 0;

        // Fetch university data where nilai_rnm <= overallAverage
        $eligibleUniversities = DB::table('universities')
            ->where('nilai_rnm', '<=', $overallAverage)
            ->get();

        // Save or update the eligibility result in the database
        DB::table('eligibility_results')->updateOrInsert(
            ['user_id' => Auth::id()],
            [
                'grades' => json_encode($grades),
                'overall_average' => $overallAverage,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        return view('cek-eligibilitas.hasil', [
            'overallAverage' => $overallAverage,
            'eligibleUniversities' => $eligibleUniversities
        ]);
    }
}
