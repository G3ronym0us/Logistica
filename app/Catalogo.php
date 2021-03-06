<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    protected $table = 'catalogos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'unidad_medida',
        'valor'
    ];
}
