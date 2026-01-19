<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = [
        'link',
        'category_id',
        'title',
        'description',
        'publisher',
        'release_date',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
