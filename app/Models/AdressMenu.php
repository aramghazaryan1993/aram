<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdressMenu extends Model
{
    use HasFactory;

    protected $table = 'adress_menus';

    protected $fillable = [
        'name', 'menu_id'
    ];
}
