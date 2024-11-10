<?php

namespace Core\Models;

use Illuminate\Database\Eloquent\Model;

class Themes extends Model
{
    protected $table = "tl_themes";

    protected $fillable = array('name');
}
