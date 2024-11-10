<?php

namespace Core\Models;

use Illuminate\Database\Eloquent\Model;

class TlBlogsCategory extends Model
{
    protected $guarded = [];

    public function blog()
    {
        return $this->belongsTo(TlBlog::class,'blog_id');
    }
}
