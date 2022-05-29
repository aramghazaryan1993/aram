<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    use HasFactory;

    protected $table='submenus';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function SubMenu() {
        return $this->hasOne(Menu::class);
    }
}
