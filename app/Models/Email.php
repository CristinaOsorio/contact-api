<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Contact;

class Email extends Model
{
    use HasFactory;

    protected $table = 'emails';

    protected $fillable =[
        'address'
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
