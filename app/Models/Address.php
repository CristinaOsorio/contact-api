<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Contact;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    protected $fillable =[
        'loaction'
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
