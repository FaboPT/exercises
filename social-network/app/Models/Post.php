<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";

    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $guarded = ['id'];

}
