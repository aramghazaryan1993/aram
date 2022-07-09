<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectHomeService extends Model
{
    use HasFactory;
    protected $table = 'select_home_services';

    protected $fillable = ['menu_id'];
}
