<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelCustomerRequest extends Model
{
    use HasFactory;

    protected $table='model_customer_requests';

    protected $fillable = [
        'id_video', 
        'id_user',
        'status',
        'acces_start',
        'acces_end',
         
    ];

    public function video()
    {
        return $this->hasOne(ModelVideo::class, 'id', 'id_video');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
