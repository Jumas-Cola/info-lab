<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class RecaptchaApi
{
    protected static Response $response;

    public function verify(string $token): void
    {
        static::$response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('recaptcha.secret_key'),
            'response' => $token,
        ]);
    }

    public function getResponse(): Response
    {
        return static::$response;
    }

    public function isOk(): bool
    {
        return static::$response->json()['success'];
    }
}
