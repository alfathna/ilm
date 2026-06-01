@extends('layouts.admin')

@section('title', 'Tentang Kami')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Page Header --}}
    <div class="mb-10">
        <div class="flex items-center gap-4 mb-2">
            <div class="h-0.5 w-12 bg-red-600"></div>
            <h1 class="text-3xl font-black text-gray-900 uppercase tracking-tighter">Tentang Kami</h1>
        </div>
        <div class="flex items-center gap-2 text-[11px] font-bold text-gray-400 uppercase ml-16">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-red-500 transition-colors">Home</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
            <span class="text-red-500">Modul Web &bull; Tentang Kami</span>
        </div>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
    <div class="mb-6 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl text-sm font-bold">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl text-sm font-bold">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.web.about.save') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- ── GAMBAR ── --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-6">
            <div class="px-8 py-5 border-b border-gray-100 flex items-center gap-3">
                <div class="w-1 h-5 bg-red-600 rounded-full"></div>
                <h2 class="text-[11px] font-black text-gray-500 uppercase tracking-widest">Gambar Halaman</h2>
            </div>
            <div class="p-8 space-y-6">
                {{-- Preview --}}
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Gambar Saat Ini</p>
                    <div id="about-image-preview-wrap" class="w-full aspect-video bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl overflow-hidden flex items-center justify-center">
                        @if(!empty($settings['about_image']))
                            <img id="about-image-preview"
                                 src="{{ Storage::url($settings['about_image']) }}"
                                 alt="Gambar Tentang Kami"
                                 class="w-full h-full object-cover">
                        @else
                            <div id="about-image-placeholder" class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto text-gray-300 mb-2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                <p class="text-[10px] font-bold text-gray-300 uppercase tracking-widest">Belum ada gambar</p>
                            </div>
                            <img id="about-image-preview" src="" alt="" class="w-full h-full object-cover hidden">
                        @endif
                    </div>
                </div>

                {{-- Upload --}}
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Upload Gambar Baru</p>
                    <input
                        type="file"
                        name="about_image"
                        id="about-image-input"
                        accept="image/png,image/jpeg,image/webp"
                        class="block w-full text-[10px] text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-red-50 file:text-red-700 hover:file:bg-red-100 transition-all"
                    >
                    <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mt-2">Format: PNG, JPG, WEBP &bull; Rekomendasi: 1200×675px (16:9) &bull; Maks. 2MB</p>
                </div>
            </div>
        </div>

        {{-- ── DESKRIPSI ── --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-6">
            <div class="px-8 py-5 border-b border-gray-100 flex items-center gap-3">
                <div class="w-1 h-5 bg-red-600 rounded-full"></div>
                <h2 class="text-[11px] font-black text-gray-500 uppercase tracking-widest">Deskripsi</h2>
            </div>
            <div class="p-8">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-3">Paragraf Deskripsi Singkat</label>
                <textarea
                    name="about_description"
                    rows="5"
                    placeholder="Tuliskan deskripsi singkat tentang organisasi/media Anda..."
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm text-gray-700 font-medium focus:outline-none focus:ring-2 focus:ring-red-100 transition-all resize-none"
                >{{ old('about_description', $settings['about_description'] ?? '') }}</textarea>
                <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mt-2">Maks. 2000 karakter</p>
            </div>
        </div>

        {{-- ── VISI & MISI ── --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-6">
            <div class="px-8 py-5 border-b border-gray-100 flex items-center gap-3">
                <div class="w-1 h-5 bg-red-600 rounded-full"></div>
                <h2 class="text-[11px] font-black text-gray-500 uppercase tracking-widest">Visi &amp; Misi</h2>
            </div>
            <div class="p-8 space-y-8">
                {{-- Visi --}}
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-3">Visi</label>
                    <textarea
                        name="about_visi"
                        rows="4"
                        placeholder="Tuliskan pernyataan visi organisasi Anda..."
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm text-gray-700 font-medium focus:outline-none focus:ring-2 focus:ring-red-100 transition-all resize-none"
                    >{{ old('about_visi', $settings['about_visi'] ?? '') }}</textarea>
                </div>

                {{-- Misi --}}
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-3">Misi</label>
                    <textarea
                        name="about_misi"
                        rows="6"
                        placeholder="Tuliskan poin-poin misi. Gunakan baris baru untuk setiap poin..."
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm text-gray-700 font-medium focus:outline-none focus:ring-2 focus:ring-red-100 transition-all resize-none"
                    >{{ old('about_misi', $settings['about_misi'] ?? '') }}</textarea>
                    <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mt-2">Tip: pisahkan tiap poin misi dengan baris baru (Enter)</p>
                </div>
            </div>
        </div>

        {{-- ── KONTAK ── --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-8">
            <div class="px-8 py-5 border-b border-gray-100 flex items-center gap-3">
                <div class="w-1 h-5 bg-red-600 rounded-full"></div>
                <h2 class="text-[11px] font-black text-gray-500 uppercase tracking-widest">Kontak</h2>
            </div>
            <div class="p-8 space-y-6">
                {{-- Alamat --}}
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-3">
                        <span class="inline-flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            Alamat
                        </span>
                    </label>
                    <textarea
                        name="about_alamat"
                        rows="3"
                        placeholder="Contoh: Jl. Raya Bypass Kenanten No. 15, Puri, Mojokerto"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm text-gray-700 font-medium focus:outline-none focus:ring-2 focus:ring-red-100 transition-all resize-none"
                    >{{ old('about_alamat', $settings['about_alamat'] ?? '') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- WhatsApp --}}
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-3">
                            <span class="inline-flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.18L6.52 2a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 9a16 16 0 0 0 6 6l.86-.87a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 21.46 16l-.54.92z"/></svg>
                                WhatsApp
                            </span>
                        </label>
                        <input
                            type="text"
                            name="about_whatsapp"
                            value="{{ old('about_whatsapp', $settings['about_whatsapp'] ?? '') }}"
                            placeholder="+62 813 5555 1234"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm text-gray-700 font-medium focus:outline-none focus:ring-2 focus:ring-red-100 transition-all"
                        >
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-3">
                            <span class="inline-flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                Email
                            </span>
                        </label>
                        <input
                            type="email"
                            name="about_email"
                            value="{{ old('about_email', $settings['about_email'] ?? '') }}"
                            placeholder="redaksi@infolantasmojokerto.com"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm text-gray-700 font-medium focus:outline-none focus:ring-2 focus:ring-red-100 transition-all"
                        >
                    </div>
                </div>
            </div>
        </div>

        {{-- Submit --}}
        <div class="flex items-center justify-between">
            <a href="{{ route('about') }}" target="_blank" class="flex items-center gap-2 text-[11px] font-bold text-gray-400 hover:text-red-600 uppercase tracking-widest transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                Lihat Halaman Publik
            </a>
            <button type="submit" class="px-12 py-3 bg-red-700 text-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-lg shadow-red-900/40 hover:bg-red-800 transition-all active:scale-95">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Live preview for about image
    document.getElementById('about-image-input').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = (ev) => {
            const img = document.getElementById('about-image-preview');
            const placeholder = document.getElementById('about-image-placeholder');
            img.src = ev.target.result;
            img.classList.remove('hidden');
            if (placeholder) placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    });
</script>
@endpush
@endsection
