<?php

namespace Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class TlBlogCategory extends Model
{
    protected $guarded = [];

    public function translation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $category_translations = $this->category_translations->where('lang', $lang)->first();
        return $category_translations != null ? $category_translations->$field : $this->$field;
    }

    // Category Has Many Translation
    public function category_translations()
    {
        return $this->hasMany(TlBlogCategoryTranslation::class, 'category_id');
    }

    // Getting a Categories Parent
    public function parentCategory()
    {
        return $this->belongsTo(self::class, 'parent')->select(['id', 'name']);
    }
    
    // For all the Child Comment
    public function childs()
    {
        return $this->hasMany($this, 'parent')->orderBy('id', 'ASC');
    }

    // For all the Active/Publish Child Comment
    public function active_childs()
    {
        return $this->hasMany($this, 'parent')->where('is_publish','1')->orderBy('id', 'ASC')->select(['id','name','permalink','parent']);
    }

    public function blogs()
    {
        return $this->belongsToMany(TlBlog::class, 'tl_blogs_categories', 'category_id', 'blog_id');
    }
    
}
