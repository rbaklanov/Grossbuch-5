<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    protected $primaryKey = 'routine_id';

    protected $fillable = [
        'routine_name', 'client_id', 'description'
    ];
}
