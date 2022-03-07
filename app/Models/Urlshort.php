<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Urlshort extends Model
{
    use HasFactory;
    protected $fillable = ['id','url'];
    protected $casts = ['id' => 'string'];
    public $incrementing = false; // 避免id寫入時總是為0
}