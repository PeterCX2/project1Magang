<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Film extends Model implements AuditableContract
{
    use SoftDeletes, AuditableTrait;

    protected $fillable = [
        'link',
        'category_id',
        'title',
        'description',
        'publisher',
        'release_date',
    ];

    protected $auditInclude = [
        'link',
        'category_id',
        'title',
        'description',
        'publisher',
        'release_date'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
