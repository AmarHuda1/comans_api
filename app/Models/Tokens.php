<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tokens extends Model
{
    //
    protected $table = 'tokens';
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'user_id','token'
    ];


}
