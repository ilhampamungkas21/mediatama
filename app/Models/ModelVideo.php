<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelVideo extends Model
{
    use HasFactory;

    protected $table='model_videos';

    protected $fillable = [
        'name_video', 
        'url_video', 
    ];
}
