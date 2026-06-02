@extends('layouts.admin')

@section('title', 'Popup')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-10">
        <div class="flex items-center gap-4 mb-2">
            <div class="h-0.5 w-12 bg-red-600"></div>
            <h1 class="text-3xl font-black text-gray-900 uppercase tracking-tighter">Popup Website</h1>
        </div>
        <div class="flex items-center gap-2 text-[11px] font-bold text-gray-400 uppercase ml-16">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-red-500 transition-colors">Home</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
            <span class="text-red-500">Modul Web &bull; Popup</span>
        </div>
    </div>


    @if($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl text-sm font-bold">
        {{ $errors->first() }}
    </div>
    @endif

    <form action="{{ route('admin.web.popup.save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-8 space-y-8">

                {{-- Gambar Popup --}}
                <div class="space-y-4">
                    <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">Gambar Popup</h3>
                    <p class="text-xs text-gray-500">Upload gambar yang akan ditampilkan sebagai popup saat pengunjung pertama kali membuka website dalam sesi baru.</p>

                    {{-- Preview --}}
                    @if($popupUrl)
                    <div class="relative w-64 rounded-xl overflow-hidden border border-gray-200 shadow-sm">
                        <img id="popup-preview" src="{{ $popupUrl }}" alt="Popup Preview" class="w-full h-auto object-cover">
                        <div class="absolute top-2 left-2 bg-green-500 text-white text-[9px] font-black uppercase px-2 py-0.5 rounded-full">Aktif</div>
                    </div>
                    @else
                    <div class="w-64 h-40 bg-gray-50 border-2 border-dashed border-gray-200 rounded-xl flex items-center justify-center" id="popup-placeholder">
                        <span class="text-[10px] text-gray-400 font-bold uppercase">Belum ada gambar</span>
                    </div>
                    @endif

                    <input
                        type="file"
                        name="popup_image"
                        id="popup-image-input"
                        accept="image/png,image/jpeg,image/webp,image/gif"
                        class="block w-full text-[10px] text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-red-50 file:text-red-700 hover:file:bg-red-100 transition-all"
                    >
                    <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Format: PNG, JPG, WEBP, GIF &bull; Maks. 2MB &bull; Rekomendasi: 600×800px (portrait)</p>
                </div>

                {{-- Link Tujuan --}}
                <div class="space-y-4">
                    <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">Link Tujuan <span class="text-gray-400 font-medium normal-case">(opsional)</span></h3>
                    <input
                        type="url"
                        name="popup_link"
                        value="{{ old('popup_link', $popupLink) }}"
                        placeholder="https://example.com"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-red-100 transition-all"
                    >
                    <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Biarkan kosong jika popup tidak perlu diklik</p>
                </div>

                {{-- Status --}}
                <div class="space-y-4">
                    <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">Status Popup</h3>
                    <div class="flex items-center gap-8">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="popup_active" value="1" {{ $popupActive ? 'checked' : '' }} class="w-4 h-4 text-red-600 border-gray-300 focus:ring-red-500">
                            <span class="text-xs font-black text-gray-500 uppercase tracking-widest">Aktif</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="popup_active" value="0" {{ !$popupActive ? 'checked' : '' }} class="w-4 h-4 text-red-600 border-gray-300 focus:ring-red-500">
                            <span class="text-xs font-black text-gray-500 uppercase tracking-widest">Tidak Aktif</span>
                        </label>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-100 flex justify-end">
                    <button type="submit" class="px-12 py-3 bg-red-700 text-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-lg shadow-red-900/40 hover:bg-red-800 transition-all active:scale-95">
                        Simpan Popup
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.getElementById('popup-image-input').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = (ev) => {
            // Replace placeholder or update existing preview
            const placeholder = document.getElementById('popup-placeholder');
            if (placeholder) {
                placeholder.innerHTML = `<img id="popup-preview" src="${ev.target.result}" class="w-full h-auto object-cover">`;
            } else {
                const preview = document.getElementById('popup-preview');
                if (preview) preview.src = ev.target.result;
            }
        };
        reader.readAsDataURL(file);
    });
</script>
@endpush
@endsection
