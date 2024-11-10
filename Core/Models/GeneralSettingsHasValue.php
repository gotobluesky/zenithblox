<?php

namespace Core\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSettingsHasValue extends Model
{
    protected $table = "tl_general_settings_has_values";

    protected $fillable = ['value', 'settings_id'];
}
