<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MixNetAmount extends Model
{
    public $fillable =[
  		'YearMonth','year','month','week','q_year','mes_name','bodega','q_invoice','monto_neto','brand','type','tipo_lente','gamma','design','material','material_color','treatment','type_article','Client','cliente','Tradename','clasificac','pais_de_env','regionales','City','clasific_estrat','Strategic','Grouping','bdr'
    ];

    protected $table = 'mix_net_amount';
}
