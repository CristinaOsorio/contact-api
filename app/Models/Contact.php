<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\PhoneNumber;
use App\Models\Email;
use App\Models\Address;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable =[
        'name',
        'notes',
        'birthday',
        'website',
        'company',
    ];

    public function phoneNumbers()
    {
        return $this->hasMany(PhoneNumber::class);
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
