<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regiones';

    protected $fillable = ['nombre'];

    public function municipios() { return $this->hasMany(Municipio::class); }
    public function promotores() { return $this->hasMany(Promotor::class); }
}
