<?php

namespace App\Http\Controllers;

use App\Http\Requests\AiTeacherRequest;
use Illuminate\Support\Facades\Validator;
use TeaRiot\YandexGpt\Cloud;
use TeaRiot\YandexGpt\Methods\Completion;

class AiTeacherController extends Controller
{
    private Cloud $yandexGpt;

    private string $folderId;

    public function __construct()
    {
        $this->folderId = config('yandex-gpt.folder_id');
        $this->yandexGpt = new Cloud(config('yandex-gpt.oauth_token'), $this->folderId);

        parent::__construct();
    }

    public function index()
    {
        return view('ai-teacher');
    }

    public function send(AiTeacherRequest $request)
    {
        $messages = $request->get('messages');

        $completion = new Completion;
        $completion->setMaxTokens(1000);

        $context = [
            [
                'role' => $completion::SYSTEM,
                'text' => 'Ты учитель информатики. Твоя задача - подробно и понятно отвечать на вопросы или объяснять.',
            ],
        ];

        foreach ($messages as $message) {
            if ($message['isTeacher']) {
                $context[] = [
                    'role' => $completion::ASSISTANT,
                    'text' => $message['text'],
                ];
            } else {
                $validator = Validator::make($message, [
                    'text' => 'required|max:1000',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'code' => 413,
                        'message' => 'Payload Too Large',
                    ], 413);
                }

                $context[] = [
                    'role' => $completion::USER,
                    'text' => $message['text'],
                ];
            }
        }

        $completion->setModelUri($this->folderId, 'yandexgpt-lite/latest')
            ->setTextMaxCount(7)
            ->setTextLength(30000)
            ->addText($context);

        $result = $this->yandexGpt->request($completion);

        $response = json_decode($result, true);

        return response()->json([
            'text' => $response['result']['alternatives'][0]['message']['text'],
            'isTeacher' => true,
            'data' => now(),
        ]);
    }
}
