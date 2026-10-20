<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotor extends Model
{
    protected $table = 'promotores';

    protected $fillable = ['region_id', 'nombre_completo', 'estatus'];

    public function region() { return $this->belongsTo(Region::class); }
    public function grupos() { return $this->hasMany(Grupo::class); }
}
