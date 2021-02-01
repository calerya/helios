<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Archivo extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'nombre', 'ruta_archivo',
    ];
    
    public function proyecto(){
        
        return $this->belongsTo(‘App\Proyecto’);
        
    }

    
    
}
