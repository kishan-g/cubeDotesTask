<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $table = 'role';
    protected $fillable = [
        'title','status'
    ];
    public function users()
    {
        return $this->belongsToMany('App\Model\User', 'role_user','role_id','user_id');
    }
}
