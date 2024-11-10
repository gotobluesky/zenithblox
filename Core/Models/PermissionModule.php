<?php
namespace Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermissionModule extends Model{
    use HasFactory;
    protected $table = "permission_module";
    protected $guarded = [];
}