<?php

namespace Core\Views\Composer;

use Core\Models\Language;
use Illuminate\View\View;
use Illuminate\Support\Facades\Config;
use Core\Repositories\LanguageRepository;

class Core
{
    protected $language_repository;
    public $active_langs;
    public $active_lang;
    public $style_path = "light";
    public $mood = "light";

    public function __construct(LanguageRepository $language_repository)
    {
        $this->language_repository = $language_repository;
        $this->active_langs = $this->language_repository->allLanguages([1]);
        if (session()->has('locale')) {
            $locale = session()->get('locale', Config::get('app.locale'));
        } else {
            $locale = getDefaultLang();
        }
        
        $this->active_lang = Language::where('code', $locale)->first();

        $this->mood = session()->get('mood', $this->mood);

        if ($this->active_lang->is_rtl == config('settings.general_status.active') && $this->mood == 'dark') {
            $this->style_path = 'rtl_dark';
        }

        if ($this->active_lang->is_rtl == config('settings.general_status.active') && $this->mood == 'light') {
            $this->style_path = 'rtl';
        }

        if ($this->active_lang->is_rtl == config('settings.general_status.in_active') && $this->mood == 'dark') {
            $this->style_path = 'dark';
        }
    }
    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        $view->with('active_langs',  $this->active_langs)
            ->with('active_lang', $this->active_lang)
            ->with('style_path', $this->style_path)
            ->with('mood', $this->mood);
    }
}
