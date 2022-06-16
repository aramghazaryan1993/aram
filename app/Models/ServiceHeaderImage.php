<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceHeaderImage extends Model
{
    use HasFactory;
    protected $table = 'service_header_images';

    protected $fillable = [
        'image', 'menu_id'
    ];
}
