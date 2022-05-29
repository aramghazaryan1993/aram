<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
   // protected $fillable = ['menu'];

    protected $table='menus';


    public function Menu()
    {
        return $this->hasMany(SubMenu::class,'menu_id','id');
    }

    public function chiledMenu()
    {
        return $this->hasMany(ChildeMenu::class,'submenu_id','id');
    }
}
