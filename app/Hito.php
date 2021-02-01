<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hito extends Model
{
    use SoftDeletes;
    
    protected $dates = ['fec_sol_ind', 'fec_obt_ind','fec_com_dis','fec_contest'];
    
    protected $fillable = [
    'hito_numero','fec_sol_ind', 'fec_obt_ind','fec_com_dis','fec_contest','proyecto_id'
    ];
    
    public function proyecto(){
    return $this->belongsTo(‘App\proyecto’);
    }
    
}
