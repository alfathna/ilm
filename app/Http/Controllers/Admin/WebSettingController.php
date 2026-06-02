<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class WebSettingController extends Controller
{
    // ─── LOGO ──────────────────────────────────────────────────────────────────

    public function logo(): View
    {
        $logoPath = WebSetting::get('logo_path');
        $logoUrl  = $logoPath ? Storage::url($logoPath) : asset('LogoBaruILM.png');

        return view('admin.web.logo', compact('logoUrl', 'logoPath'));
    }

    public function saveLogo(Request $request): RedirectResponse
    {
        $request->validate([
            'logo' => 'required|image|mimes:png,jpg,jpeg,svg,webp|max:500',
        ], [
            'logo.required' => 'Pilih file logo terlebih dahulu.',
            'logo.image'    => 'File harus berupa gambar.',
            'logo.mimes'    => 'Format logo harus PNG, JPG, SVG, atau WEBP.',
            'logo.max'      => 'Ukuran logo maksimal 500 KB.',
        ]);

        // Delete old logo from storage (only if it was stored in storage, not the default asset)
        $oldPath = WebSetting::get('logo_path');
        if ($oldPath && Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }

        // Store new logo
        $path = $request->file('logo')->store('web', 'public');
        WebSetting::set('logo_path', $path);

        return back()->with('success', 'Logo berhasil diperbarui.');
    }

    // ─── POPUP ─────────────────────────────────────────────────────────────────

    public function popup(): View
    {
        $popupImage  = WebSetting::get('popup_image');
        $popupLink   = WebSetting::get('popup_link');
        $popupActive = (bool) WebSetting::get('popup_active', '0');
        $popupUrl    = $popupImage ? Storage::url($popupImage) : null;

        return view('admin.web.popup', compact('popupUrl', 'popupLink', 'popupActive'));
    }

    public function savePopup(Request $request): RedirectResponse
    {
        $request->validate([
            'popup_image' => 'nullable|image|mimes:png,jpg,jpeg,webp,gif|max:2048',
            'popup_link'  => 'nullable|url|max:500',
            'popup_active'=> 'required|in:0,1',
        ], [
            'popup_image.image' => 'File harus berupa gambar.',
            'popup_image.max'   => 'Ukuran gambar popup maksimal 2 MB.',
            'popup_link.url'    => 'Link tujuan harus berupa URL yang valid (contoh: https://example.com).',
        ]);

        // Handle popup image upload
        if ($request->hasFile('popup_image')) {
            $oldPath = WebSetting::get('popup_image');
            if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('popup_image')->store('web/popup', 'public');
            WebSetting::set('popup_image', $path);
        }

        WebSetting::set('popup_link', $request->input('popup_link'));
        WebSetting::set('popup_active', $request->input('popup_active'));

        return back()->with('success', 'Pengaturan popup berhasil disimpan.');
    }

    // ─── TEMA ──────────────────────────────────────────────────────────────────

    public function tema(): View
    {
        $activeColor = WebSetting::get('theme_color', '#dc2626');

        $themes = [
            ['name' => 'Merah',  'color' => '#dc2626', 'class' => 'bg-red-600'],
            ['name' => 'Kuning', 'color' => '#eab308', 'class' => 'bg-yellow-500'],
            ['name' => 'Biru',   'color' => '#2563eb', 'class' => 'bg-blue-600'],
            ['name' => 'Ungu',   'color' => '#9333ea', 'class' => 'bg-purple-600'],
            ['name' => 'Hijau',  'color' => '#16a34a', 'class' => 'bg-green-600'],
        ];

        return view('admin.web.tema', compact('themes', 'activeColor'));
    }

    public function saveTema(Request $request): RedirectResponse
    {
        $allowedColors = ['#dc2626', '#eab308', '#2563eb', '#9333ea', '#16a34a'];

        $request->validate([
            'theme_color' => 'required|in:' . implode(',', $allowedColors),
        ], [
            'theme_color.required' => 'Pilih salah satu warna tema.',
            'theme_color.in'       => 'Warna yang dipilih tidak valid.',
        ]);

        WebSetting::set('theme_color', $request->input('theme_color'));

        return back()->with('success', 'Tema berhasil diperbarui. Warna akan langsung tampil di halaman user.');
    }

    // ─── IDENTITAS ─────────────────────────────────────────────────────────────

    public function identitas(): View
    {
        $settings = WebSetting::all_cached();

        return view('admin.web.identitas', compact('settings'));
    }

    public function saveIdentitas(Request $request): RedirectResponse
    {
        $request->validate([
            'site_name'        => 'required|string|max:100',
            'site_description' => 'nullable|string|max:255',
            'social_facebook'  => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_youtube'   => 'nullable|url|max:255',
            'social_tiktok'    => 'nullable|url|max:255',
        ]);

        $fields = [
            'site_name', 'site_description',
            'social_facebook', 'social_instagram', 'social_youtube', 'social_tiktok',
        ];

        foreach ($fields as $field) {
            WebSetting::set($field, $request->input($field));
        }

        return back()->with('success', 'Identitas website berhasil disimpan.');
    }

    // ─── TENTANG KAMI ──────────────────────────────────────────────────────────

    public function aboutPage(): View
    {
        $settings = WebSetting::all_cached();

        return view('admin.web.tentang-kami', compact('settings'));
    }

    public function saveAboutPage(Request $request): RedirectResponse
    {
        $request->validate([
            'about_image'       => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'about_description' => 'nullable|string|max:2000',
            'about_visi'        => 'nullable|string|max:1000',
            'about_misi'        => 'nullable|string|max:2000',
            'about_alamat'      => 'nullable|string|max:255',
            'about_whatsapp'    => 'nullable|string|max:30',
            'about_email'       => 'nullable|email|max:100',
        ], [
            'about_image.image' => 'File harus berupa gambar.',
            'about_image.max'   => 'Ukuran gambar maksimal 2 MB.',
            'about_email.email' => 'Format email tidak valid.',
        ]);

        // Handle image upload
        if ($request->hasFile('about_image')) {
            $oldPath = WebSetting::get('about_image');
            if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('about_image')->store('web/about', 'public');
            WebSetting::set('about_image', $path);
        }

        $fields = [
            'about_description', 'about_visi', 'about_misi',
            'about_alamat', 'about_whatsapp', 'about_email',
        ];

        foreach ($fields as $field) {
            WebSetting::set($field, $request->input($field));
        }

        return back()->with('success', 'Halaman Tentang Kami berhasil diperbarui.');
    }
}
