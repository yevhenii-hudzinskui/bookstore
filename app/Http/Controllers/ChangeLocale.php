<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ChangeLocale extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $locale = $request->input('locale');

        abort_if(!in_array($locale, config('app.locales')), 404);

        $request->session()->put('locale', $locale);
//        $request->session()->forget('locale');

        return to_route('dashboard');
    }
}
