<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Municipio as  Municipio;

class Correlativo extends Model
{
    protected $table = 'correlativos';
    protected $primaryKey = 'id';

    protected $fillable = ['municipio_id',
                            'n_partida',
                            'proyecto',
                            'beneficiario_id',
                            'orden_compra'];

    public function municipio()
    {
        return $this->belongsTo(Municipio::Class);
    }
}
