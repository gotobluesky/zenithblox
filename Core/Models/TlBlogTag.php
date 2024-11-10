<?php

namespace Core\Models;

use Core\Models\TlBlog;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;

class TlBlogTag extends Model
{
    protected $guarded = [];

    public function translation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $tag_translations = $this->tag_translations->where('lang', $lang)->first();
        return $tag_translations != null ? $tag_translations->$field : $this->$field;
    }

    // Tag has Many translations
    public function tag_translations()
    {
        return $this->hasMany(TlBlogTagTranslation::class, 'tag_id');
    }
    
    public function blogs()
    {
        return $this->belongsToMany(TlBlog::class, 'tl_blogs_tags', 'tag_id', 'blog_id');
    }
}
