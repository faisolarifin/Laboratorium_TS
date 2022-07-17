<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\{
    AkunMhs, 
    Setting, };
use Illuminate\Http\Request;

class CekLoginMhs
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
        if (session()->get('id') !== NULL && session()->get('role') == 'MHS') {
            if (AkunMhs::find(session()->get('id'))->status == 'non-aktif') {
                return redirect()->route('mhs.profile');
            }
            $request->currentPeriode = Setting::find(1)->periode_aktif;
            return $next($request);
        }
        abort(404);
    }
}
