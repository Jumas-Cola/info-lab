<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function send(Request $request)
    {
        $message = $request->get('message');

        if (! empty($message)) {
            $completion = new Completion;

            $completion->setModelUri($this->folderId, 'yandexgpt-lite/latest')
                ->addText([
                    [
                        'role' => $completion::SYSTEM,
                        'text' => 'Ты учитель информатики. Твоя задача - подробно и понятно отвечать на вопросы или объяснять.',
                    ],
                    [
                        'role' => $completion::USER,
                        'text' => $message,
                    ],
                ]);

            $result = $this->yandexGpt->request($completion);

            $response = json_decode($result, true);

            return response()->json([
                'text' => $response['result']['alternatives'][0]['message']['text'],
                'isTeacher' => true,
                'data' => now(),
            ]);
        }
    }
}
