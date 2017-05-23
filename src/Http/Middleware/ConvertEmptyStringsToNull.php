<?php

namespace Metrique\Building\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\TransformsRequest;

class ConvertEmptyStringsToNull extends TransformsRequest
{
    protected $except = [
        'dashboard/*',
    ];
    
    protected $skipTransform = false;
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$attributes)
    {
        if ($this->inExceptArray($request)) {
            $this->skipTransform = true;
        }

        return $next($request);
    }
    
    /**
     * Transform the given value.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    protected function transform($key, $value)
    {
        if ($this->skipTransform) {
            return $value;
        }
        
        return is_string($value) && $value === '' ? null : $value;
    }
    
    /**
     * Determine if the request has a URI that should pass through verification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function inExceptArray($request)
    {
        foreach ($this->except as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->is($except)) {
                return true;
            }
        }

        return false;
    }
}
