<?php
namespace Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model{
    use HasFactory;
    protected $table = "tl_menus";
}