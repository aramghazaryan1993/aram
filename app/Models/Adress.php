<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
    use HasFactory;
    protected $table = "adress";

    protected $fillable = [
        'map', 'text', 'adress_menu_id'
    ];

//    public function getAdressMenu()
//    {
//        return $this->hasOne('App\Models\AdressMenu');
//    }
}
