<?php

namespace App\Http\Controllers;

use App\Models\Urlshort;
use App\Rules\not_self_domain;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class UrlshortController extends Controller
{
    function index(){
        $url_history = json_decode(Cookie::get('url_history'),TRUE);
        $url_histories = getUrlHistoriesFromCookie($url_history);

        return view('urlshorts.index',compact('url_histories'));
    }

    function store(Request $request){
        $validated = $request->validate([
            'url'=>['required','url',new not_self_domain]
        ]);

        $url = request('url');

        $urlshorts = Urlshort::firstOrCreate(
            ['url' => $url],
            ['id' => genID()]
        );

        $id = $urlshorts->id;

        $domain_name = request()->getHost();
        $shorten_url = "$domain_name/$id";

        // cookie
        $url_history = Cookie::get('url_history');

        if(empty($url_history)){
            $url_history = [$urlshorts->id];
        }else{
            $url_history = json_decode($url_history,TRUE);
            $url_history = Arr::prepend($url_history,$urlshorts->id);
            $url_history = array_unique($url_history);
        }
        $cookie = cookie('url_history',json_encode($url_history));

        return redirect()->route('urlshorts.index')->with( compact('shorten_url','url') )->withCookie($cookie);
    }

    function redirect(Urlshort $urlshorts){
        Urlshort::find($urlshorts->id)->increment('used');
        $urlshorts->touch();
        return redirect( $urlshorts->url );
    }
}

function genID(){
    // 避免重複
    while(1){
        $id = (string) Str::random(7);
        if(Urlshort::where('id',$id)->count() == 0){
            return $id;
        }
    }
}

function getUrlHistoriesFromCookie($cookie_histories){
    
    if( empty($cookie_histories) ){
        return null;
    }
    
    $url_histories = Urlshort::whereIn('id',$cookie_histories)->get();

    $result = [];

    foreach($url_histories as $url_history){
        foreach($cookie_histories as $key => $cookie){
            if( $url_history['id'] == $cookie ){
                $result[$key] = $url_history;
                unset($cookie_histories[$key]);
            }
        }
    }
    unset($cookie_histories);
    ksort($result);
    return $result;
}
