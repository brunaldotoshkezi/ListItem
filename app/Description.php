<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Description extends Model
{
    use SoftDeletes;
    public $fillable = ['author','title','description'];

    public function listitem(){
        return $this->belongsTo(Listitem::class);
    }

    public function scopeOfListitem($query, $listitemId){
        return $query->where('listitem_id', $listitemId);
    }
}
