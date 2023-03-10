<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory, SoftDeletes;
/**
 * Get User Role
 */
public function role()
{
   return $this->belongsTo(Role::class,'role_id');
}
public function logs()
{
    return $this->hasMany(Log::class,'user_id');
}
public function branch(){
    return $this->hasOne(Branch::class,'user_id');
}
public function warehouse()
{
    return $this->hasOne(WhsDetail::class,'user_id');
}
    protected $table = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
      'user_id', 'name','username','contact', 'email','password', 'role_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
    ];
}
