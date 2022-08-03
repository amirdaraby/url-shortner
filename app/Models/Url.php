<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    protected $guarded = ["id"];



    public function shorturl()
    {
        return $this->hasMany(ShortUrl::class, "url_id");
    }

    public function clicks()
    {
        return $this->hasManyThrough(Click::class, ShortUrl::class);
    }


}
