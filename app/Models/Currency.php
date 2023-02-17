<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $appends = ['name_and_symbol'];

    public function getNameAndSymbolAttribute()
    {
        return $this->attributes['name'] . ' - ' . $this->attributes['symbol'];
    }
}
