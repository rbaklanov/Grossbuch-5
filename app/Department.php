<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $primaryKey = 'department_id';

    protected $fillable = [
        'department_name', 'client_id', 'description'
    ];

    public function position()
    {
        return $this->hasMany(Position::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
