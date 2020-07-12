<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;//allow for deletion
 
    protected $guarded = ['id'];
    
    public function items(){
        return $this->hasMany(Item::class);//Locations has a one-to-many relationship with Items
    }
}