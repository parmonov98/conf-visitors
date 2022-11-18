<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;

class AfterJson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $defaultResponse = $next($request);

        if ($defaultResponse->getStatusCode() === 200){
            $response = response(
                [
                    'status' => 'success',
                    'data' => json_decode($defaultResponse->content())
                ]
            )->withHeaders(
                $defaultResponse->headers->all()
            );
        }else{
//            dd($defaultResponse->getStatusCode(), $defaultResponse);
//            dd($defaultResponse->getStatusCode());
            $errors = [];
            if (isset($defaultResponse->exception) && isset($defaultResponse->exception->validator) && $defaultResponse->exception->validator){
                $errors = $defaultResponse->exception->validator->messages();
            }
//            dd($defaultResponse->exception->validator->messages());
            $response = response()->json(
                [
                    'status' => 'error',
                    'message' => $defaultResponse->exception->getMessage(),
                    'errors' => $errors
                ],
                $defaultResponse->getStatusCode()
            );
        }

        return $response;
    }
}
