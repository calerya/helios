<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proyecto extends Model
{

    use SoftDeletes;
    
    protected $table = "proyectos";

    protected $fillable = [
        'nom_proyecto','provincia','term_municipal',
        'sociedad','finalizado','fec_finalizacion'
    ];
    
    
    public function user(){
        
        return $this->belongsTo(User::class);
        
    }
    
    public function organismo(){
        
        return $this->hasMany(Organismo::class);
        
    }
    
    public function hito(){
        
        return $this->hasMany(Hito::class);
        
    }
    
    public function propietario(){
        
        return $this->hasMany(Propietario::class);
        
    }

    public function finca()
    {
        return $this->hasMany(Finca::class);
    }
    
    
    
    
    //------------------------------------------------------------
    // SCOPES
    //------------------------------------------------------------
    
    public function scopeNom_proyecto($query, $nom_proyecto){
        
        if($nom_proyecto)
            return $query->where('nom_proyecto', 'LIKE', "%$nom_proyecto%");
                
    }
    
    public function scopeProvincia($query, $provincia){
        
        if($provincia)
            return $query->where('provincia', 'LIKE', "%$provincia%");
                
    }
    
    public function scopeTerm_municipal($query, $term_municipal){
        
        if($term_municipal)
            return $query->where('term_municipal', 'LIKE', "%$term_municipal%");
                
    }
    
    

}
