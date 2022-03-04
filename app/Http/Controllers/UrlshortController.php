<?php

namespace App\Http\Controllers;

use App\Models\Urlshort;
use App\Rules\not_self_domain;
use Illuminate\Http\Request;

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

        $urlshorts = Urlshort::firstOrCreate([
            'url' => $url
        ]);

        $id = $urlshorts->id;
        if( $id == '0' ){
            $id = Urlshort::getID();
        }
        return view('urlshorts.index',compact('id','url'));
    }

    function redirect(Urlshort $urlshorts){
        Urlshort::find($urlshorts->id)->increment('used');
        return redirect( $urlshorts->url );
    }
}
