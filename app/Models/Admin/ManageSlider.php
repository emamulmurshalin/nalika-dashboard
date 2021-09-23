<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageSlider extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'slider_image'
    ];
}
