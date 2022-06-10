<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 * @package App\Models
 * @property string $phone
 */
class Contact extends Model
{
    use HasFactory;
    protected $table = 'contacts';

    protected $fillable = [
        'phone',
        'email',
        'working',
        'text_header',
        'text_footer',
        'facebook',
        'instagram',
        'logo',
        'image',
    ];
}
