<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    public function cacheClear()
    {
        Cache::forget('compilers');
        return redirect()->back();
    }
}
