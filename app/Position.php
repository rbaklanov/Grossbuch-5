<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $primaryKey = 'position_id';

    protected $fillable = [
        'position_name', 'department_id', 'client_id', 'description'
    ];

    public function department()
    {
        return $this->belongsTo('App\Department', 'department_id');
    }
}
