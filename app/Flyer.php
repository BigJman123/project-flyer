<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flyer extends Model
{
    
    protected $fillable = [
        
        'street',
        'city',
        'state',
        'country',
        'zip',
        'price',
        'description'
        
    ];
    /**
     * a flyer is composed of many photos
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos() 
    {
    
        return $this->hasMany('App\Photo');
        
    }
}
