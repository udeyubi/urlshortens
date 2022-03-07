<?php

namespace App\Http\Controllers;

use App\Models\Urlshort;
use App\Rules\not_self_domain;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlshortController extends Controller
{
    function index(){
        return view('urlshorts.index');
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

        return view('urlshorts.index',compact('shorten_url','url'));
    }

    function redirect(Urlshort $urlshorts){
        Urlshort::find($urlshorts->id)->increment('used');
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
