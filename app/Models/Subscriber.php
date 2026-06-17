<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $connection = 'wabepoint';
    protected $table = 'users';
    public $timestamps = false;

    protected $fillable = ['name', 'email'];
}
