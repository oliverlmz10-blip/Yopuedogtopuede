<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $fillable = ['region_id', 'nombre'];

    public function region() { return $this->belongsTo(Region::class); }
    public function grupos() { return $this->hasMany(Grupo::class); }
}
