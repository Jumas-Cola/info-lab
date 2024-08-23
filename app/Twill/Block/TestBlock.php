<?php

namespace App\Twill\Block;

use A17\Twill\Services\Blocks\Block;
use Illuminate\Support\Str;
use Psy\Util\Json;

class TestBlock extends Block
{
    public function getData(array $data, \A17\Twill\Models\Block $block): array
    {
        $data = parent::getData($data, $block);

        $questions = [];
        foreach ($block->children as $question) {
            $questionImage = $question->image('highlight', 'desktop');
            $newQuestion = [
                'id' => $question->id,
                'question' => $question->input('question'),
                'question_image' => !Str::startsWith($questionImage, 'data') ? $questionImage : null,
                'multiple_choice' => $question->input('multiple_choice'),
                'answers' => [],
            ];
            foreach ($question->children as $answer) {
                $answerImage = $answer->image('highlight', 'desktop');
                $newQuestion['answers'][] = [
                    'id' => $answer->id,
                    'answer' => $answer->input('answer'),
                    'answer_image' => !Str::startsWith($answerImage, 'data') ? $answerImage : null,
                ];
            }
            $questions[] = $newQuestion;
        }
        $block->questions = Json::encode($questions);

        return $data;
    }
}
