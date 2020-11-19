<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallesCorrelativo extends Model
{
    protected $table = 'detalles_correlativos';
    protected $primaryKey = 'id';

    protected $fillable = ['correlativo_id',
                            'catalogo_id',
                            'cantidad',
                            'subtotal'];
}
