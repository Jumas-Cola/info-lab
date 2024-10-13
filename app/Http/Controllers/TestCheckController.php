<?php

namespace App\Http\Controllers;

use A17\Twill\Models\Block;
use App\Http\Requests\TestAnswersRequest;

class TestCheckController extends Controller
{
    public function handleTestResults(TestAnswersRequest $request)
    {
        $validated = $request->validated();
        $testId = $validated['test_id'];
        $userQuestions = $validated['answers'];
        $test = Block::find($testId);
        $questions = $test->children;
        $results = [];
        $stats = new class
        {
            public int $correct = 0;

            public int $incorrect = 0;
        };
        foreach ($questions as $question) {
            $answers = $question->children;
            $userAnswers = $userQuestions[$question->id];
            $correctAnswers = $answers->filter(function ($answer) {
                return $answer->content['correct'];
            })->map(fn ($answer) => $answer->id)->toArray();

            $notMatches = array_diff($correctAnswers, $userAnswers);
            $notMatchesReverse = array_diff($userAnswers, $correctAnswers);

            if (count($notMatches) > 0 or count($notMatchesReverse) > 0) {
                $results[$question->id] = false;
                $stats->incorrect++;
            } else {
                $results[$question->id] = true;
                $stats->correct++;
            }
        }

        return response()->json(['results' => $results, 'stats' => $stats]);
    }
}
