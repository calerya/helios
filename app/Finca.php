<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Finca extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'proyecto_id','ref_catastral','provincia','municipio',
        'zona','poligono','parcela','venta_alq',
        'sup_catastral_ha','sup_util_ha','observaciones',
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}
