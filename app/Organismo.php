<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organismo extends Model
{
    
    use SoftDeletes;
    
    protected $dates = ['fec_presentacion', 'fec_requerimiento','fec_cont_requerimiento','fec_inicio_ip','fec_fin_ip',
    'fec_resolucion','fec_publ_resolucion', 'fec_caducidad', 'fec_solic_apm', 'fec_conc_apm',
    'fec_solic_prorroga','fec_concesion_pror'];
  
    
    protected $fillable = [
    'organismo','fec_presentacion','fec_requerimiento',
    'fec_cont_requerimiento','fec_inicio_ip','fec_fin_ip',
    'fec_resolucion','fec_publ_resolucion','fec_caducidad',
    'fec_solic_prorroga','fec_concesion_pror','num_prorrogas',
    'observaciones','fec_solic_apm', 'fec_conc_apm',
    ];
    
    public function proyecto(){
    return $this->belongsTo(Proyecto::class);
    }

 
   
}
