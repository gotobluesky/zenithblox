<?php

namespace Core\Models;

use Illuminate\Database\Eloquent\Model;

class Plugins extends Model
{
    protected $table = "tl_plugins";

    protected $fillable = array('name');
}
