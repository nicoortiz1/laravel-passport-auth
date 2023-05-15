<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class novedades_sueldos extends Model
{
    use HasFactory;

    protected $table = 'novedades_sueldos';
    public $timestamps = false;

    protected $fillable = ['centro', 'padron', 'codigo1', 'importe1','codigo2','importe2','codigo3','importe3','codigo4','importe4','codigo5','importe5', 'tipo_novedad'];
}
