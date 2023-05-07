<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function section(){
        return $this->belongsTo(Section::class, 'section_id', 'id')->select('id', 'name');
    }

    public function parent_category(){
        return $this->belongsTo(self::class, 'parent_id', 'id')->select('id', 'name');
    }
}
