<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\ThrottleRequests;

class CustomThrottle extends ThrottleRequests
{
    protected function resolveRequestSignature($request)
    {
        return  $request->input('secure_pin');
    }
}
