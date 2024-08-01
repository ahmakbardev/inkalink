<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PersonalityTestController extends Controller
{
    public function index()
    {
        $categories = DB::table('questions')
            ->select('category_id')
            ->distinct()
            ->orderBy('category_id')
            ->get();

        $questions = DB::table('questions')
            ->orderBy('category_id')
            ->get()
            ->groupBy('category_id');

        return view('test-kepribadian.test', compact('categories', 'questions'));
    }

    public function showTipe(Request $request)
    {
        $topCategories = $request->input('categories', []);
        if (count($topCategories) < 3) {
            $personalityTypes = DB::table('personality_types')->get();
        } else {
            $personalityTypes = DB::table('personality_types')
                ->whereIn('category_id', $topCategories)
                ->get();
        }

        return view('test-kepribadian.tipe-kepribadian', compact('personalityTypes'));
    }

    public function submitTest(Request $request)
    {
        // Extract the answers from the request
        $answers = $request->input('answers');

        // Initialize a category count array
        $categoryCounts = [];

        // Calculate the number of "yes" answers for each category
        foreach ($answers as $questionId => $answer) {
            if ($answer === 'yes') {
                $categoryId = DB::table('questions')->where('id', $questionId)->value('category_id');

                if (isset($categoryCounts[$categoryId])) {
                    $categoryCounts[$categoryId]++;
                } else {
                    $categoryCounts[$categoryId] = 1;
                }
            }
        }

        // Sort categories by the number of "yes" answers in descending order
        arsort($categoryCounts);

        // Get the top three categories
        $topCategories = array_slice(array_keys($categoryCounts), 0, 3);

        // Convert the top categories to a string format suitable for searching in the results table
        $topCategoriesString = json_encode(array_map('strval', $topCategories));

        // Fetch the corresponding result from the database
        $result = DB::table('results')->where('category_ids', $topCategoriesString)->first();

        // Get category names
        $categoryNames = DB::table('categories')
            ->whereIn('id', array_keys($categoryCounts))
            ->pluck('name', 'id')
            ->toArray();

        // Replace category IDs with names in categoryCounts
        $categoryCountsWithNames = [];
        foreach ($categoryCounts as $id => $count) {
            $categoryCountsWithNames[$categoryNames[$id]] = $count;
        }

        // Save or update the test result in the database
        DB::table('personality_test_results')->updateOrInsert(
            ['user_id' => Auth::id()],
            [
                'category_counts' => json_encode($categoryCountsWithNames),
                'top_categories' => json_encode($topCategories),
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        // Return the result and categoryCounts to the view
        return view('test-kepribadian.hasil', [
            'result' => $result,
            'categoryCounts' => $categoryCountsWithNames,
            'topCategories' => $topCategories
        ]);
    }
}
