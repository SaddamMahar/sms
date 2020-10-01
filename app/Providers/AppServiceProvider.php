<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     *
     */
    public function boot()
    {
        \Response::macro('custom', function ($data, $message, $inError, $requestId, $code, $statusCode) {
            $response = array('responseData' => $data, 'message' => $message, 'inError' => $inError,
                'requestId' => $requestId, 'code' => $code);
            return response()->json($response, $statusCode);
        });
    }
}
