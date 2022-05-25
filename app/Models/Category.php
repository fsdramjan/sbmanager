<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name']=$value;
        $this->attributes['slug']=Str::slug($value);
    }
}
