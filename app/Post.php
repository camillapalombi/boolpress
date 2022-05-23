<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = ['title', 'content', 'slug', 'user_id', 'category_id'];

    static public function generateSlug($originalStr) {
        $baseSlug = Str::of($originalStr)->slug('-')->__toString();
        $slug = $baseSlug;
        $_i = 1;
        while(self::where('slug', $slug)->first()) {
            $slug = "$baseSlug-$_i";
            $_i++;
        }
        return $slug;
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }
}
