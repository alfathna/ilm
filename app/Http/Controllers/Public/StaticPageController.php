<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\WebSetting;
use App\Services\SeoService;
use Illuminate\View\View;

class StaticPageController extends Controller
{
    public function __construct(
        protected SeoService $seoService
    ) {}

    /**
     * Display the About page (dynamic via WebSetting).
     */
    public function about(): View
    {
        $settings = WebSetting::all_cached();
        $seo = $this->seoService->generateForPage('Tentang Kami', 'Tentang ' . config('news_portal.site.name'));

        return view('public.static.about', compact('settings', 'seo'));
    }

    /**
     * Display the Redaksi page.
     */
    public function redaksi(): View
    {
        $teams = \App\Models\EditorialTeam::orderBy('order_column')->get();

        // Group by roles in the exact order requested
        $roleOrder = [
            'Pemimpin Redaksi',
            'Wakil Pemimpin Redaksi',
            'Redaktur Pelaksana',
            'Redaktur',
            'Jurnalis / Reporter',
            'Content Creator / Media Sosial',
            'Tim Produksi Audio Visual & Desain',
        ];

        // Sort the grouped teams according to $roleOrder
        $groupedTeams = $teams->groupBy('role')->sortBy(function ($item, $key) use ($roleOrder) {
            $index = array_search($key, $roleOrder);
            return $index === false ? 999 : $index;
        });

        $seo = $this->seoService->generateForPage('Susunan Redaksi', 'Susunan redaksi ' . config('news_portal.site.name'));

        return view('public.static.redaksi', compact('groupedTeams', 'seo'));
    }
}
