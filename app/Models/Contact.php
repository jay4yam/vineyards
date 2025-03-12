<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Contact extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'contacts';

    protected $fillable = ['name', 'phone','email', 'message', 'ip_address', 'sources', 'reference'];
}
