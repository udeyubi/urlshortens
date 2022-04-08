<?php

namespace App\Http\View\Composers;

use GuzzleHttp\Client;
use Illuminate\View\View;

class PageNotFoundComposer{
    
    public function compose(View $view){
        $client = new Client(['http_errors' => false]);
        $client = $client->get('https://dog.ceo/api/breeds/image/random');
        $status = $client->getStatusCode();
        if($status == '200'){
            $body = json_decode($client->getBody())->message;
        }
        $view->with('dog_img_src',$body ?? null);
    }
}