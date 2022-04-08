<?php

namespace App\Http\Controllers;

use App\Models\Urlshort;
use App\Rules\not_self_domain;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class UrlshortController extends Controller
{
    function index(){
        $url_shorts = Urlshort::all();
        return response($url_shorts,Response::HTTP_OK);
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


        return response(['success'=>compact('id','shorten_url','url')],Response::HTTP_CREATED);
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
