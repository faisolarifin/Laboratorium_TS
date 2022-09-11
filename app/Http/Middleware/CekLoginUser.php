<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\{AkunMhs, Setting, User};
use Illuminate\Http\Request;

class CekLoginUser
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

        if (auth()->user() !== NULL && in_array(auth()->user()->role, ['mahasiswa', 'dosen', 'umum'])) {
            if (User::find(auth()->user()->id_user)->status == 'non-aktif') {
                return redirect()->route('mhs.profile');
            }
            $request->currentPeriode = Setting::find(1)->periode_aktif;
            return $next($request);
        }
        abort(403);
    }
}
