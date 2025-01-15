<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    //

    use HasFactory;

    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'country',
        'street_address', 'district', 'postcode', 
        'phone', 'email'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
