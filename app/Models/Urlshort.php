<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Urlshort extends Model
{
    use HasFactory;
    protected $fillable = ['url'];
    protected $casts = ['id' => 'string'];
    public static $id;

    public static function boot(){
        parent::boot();
        self::creating(function ($model) {
            self::$id = genID();
            $model->id = self::$id;
        });
    }

    public static function getID(){
        return self::$id;
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