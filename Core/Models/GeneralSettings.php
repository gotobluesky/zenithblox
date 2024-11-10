<?php

namespace Core\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSettings extends Model
{
    protected $table = "tl_general_settings";

    protected $fillable = ['name'];
}
