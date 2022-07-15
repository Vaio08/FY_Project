<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerAccess
{
    public function handle(Request $request, Closure $next)
    {
        if (Gate::allows('is-customer')) {
            return $next($request);
        } else {
            Alert::error('Error', 'You are not eligible to access this url');
            return redirect('/');
        }
    }
}
