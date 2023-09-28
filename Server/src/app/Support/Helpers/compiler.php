<?php


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

function GetCompilersInfo()
{
    return Cache::rememberForever('compilers', function () {
        $urlServerTest = env('SERVER_TESTS_URL', 'SERVER_TESTS_URL') . '/compilers';
        return Http::get($urlServerTest)->json();
    });
}
