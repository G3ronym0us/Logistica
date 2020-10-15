<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beneficiario extends Model
{
    protected $table = 'beneficiarios';
    protected $primaryKey = 'id';

    protected $fillable = ['name'];
}
