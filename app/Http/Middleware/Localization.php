<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Language;

class Localization
{
    //protected const ALLOWED_LOCALIZATIONS = getLocalesCodes();
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $locales=getLanguages();
        $localization=$request->header('locale');
        //$localization = $request->segment(2);
        if ($localization != '') {
            $localization = in_array($localization, $locales, true) ? $localization : 'ar';
        } else {
            $localization = 'ar';
        }

        app()->setLocale($localization);

        return $next($request);
    }
}
