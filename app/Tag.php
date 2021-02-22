<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        
    ];

    public $timestamps = false;

    public function posts(){
        return $this->belongsToMany("App\Post");
    }
}
