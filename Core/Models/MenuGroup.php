<?php
namespace Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuGroup extends Model{
    use HasFactory;
    protected $table = "tl_menu_groups";
}