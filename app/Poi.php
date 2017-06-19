<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poi extends Model
{
    protected $table = 'poi';
    
    protected $fillable = ['name', 'coordinate_x', 'coordinate_y'];

    protected $hidden = [];

    protected $dates = ['inserted_at', 'updated_at', 'deleted_at'];
    
    public $rules = ['name' => 'required', 'coordinate_x' => 'required|integer|min:0', 'coordinate_y' => 'required|integer|min:0'];

}
