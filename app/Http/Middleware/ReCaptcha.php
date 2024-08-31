<?php

namespace App\Http\Middleware;

use App\Services\RecaptchaApi;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReCaptcha
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($token = $request->get('g-recaptcha-response')) {
            $recaptchaApi = $this->getRecaptchaApi();
            $recaptchaApi->verify($token);

            if (! $recaptchaApi->isOk()) {
                return response()->json(['error' => 'Invalid captcha'], 400);
            }
        }

        return $next($request);
    }

    protected function getRecaptchaApi(): RecaptchaApi
    {
        return app()->make(RecaptchaApi::class);
    }
}
