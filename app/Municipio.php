<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipios';
    protected $primaryKey = 'id';

    protected $fillable = ['name'];

    public function correlativo()
    {
        return $this->hasMany(Correlativo::Class);
    }
}

