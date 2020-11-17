<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    protected $table = 'unidad_medidas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];
}
