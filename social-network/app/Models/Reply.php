<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table = "users";

    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $guarded = ['id'];

}
