@extends('layouts.app')

@section('content')
<div class="container-custom py-16 max-w-4xl">

    {{-- ── HEADER ── --}}
    <div class="flex items-center gap-4 mb-10 w-full">
        <div class="flex-1 flex flex-col gap-[2px]">
            <div class="h-[3px] bg-primary w-full"></div>
            <div class="h-[3px] bg-primary w-full"></div>
        </div>
        <h1 class="text-3xl font-black text-primary tracking-tighter px-6 whitespace-nowrap uppercase">
            Tentang Kami
        </h1>
        <div class="flex-1 flex flex-col gap-[2px]">
            <div class="h-[3px] bg-primary w-full"></div>
            <div class="h-[3px] bg-primary w-full"></div>
        </div>
    </div>

    {{-- ── GAMBAR ── --}}
    @php $aboutImagePath = $settings['about_image'] ?? null; @endphp
    <div class="w-full aspect-video bg-gray-100 rounded-2xl overflow-hidden mb-12 shadow-xl border border-gray-100">
        @if($aboutImagePath)
            <img loading="lazy"
                 src="{{ Storage::url($aboutImagePath) }}"
                 alt="Tentang Kami"
                 class="w-full h-full object-cover">
        @else
            <img loading="lazy"
                 src="https://images.unsplash.com/photo-1495020689067-958852a7765e?auto=format&fit=crop&q=80&w=1200"
                 alt="Info Lantas Mojokerto Office"
                 class="w-full h-full object-cover">
        @endif
    </div>

    <div class="space-y-12">

        {{-- ── DESKRIPSI ── --}}
        @php $aboutDescription = $settings['about_description'] ?? null; @endphp
        @if($aboutDescription)
        <section>
            <h2 class="text-2xl font-black text-gray-800 uppercase tracking-tight mb-4 border-l-4 border-primary pl-4">
                Tentang Kami
            </h2>
            <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                <p>{{ $aboutDescription }}</p>
            </div>
        </section>
        @endif

        {{-- ── VISI ── --}}
        @php $aboutVisi = $settings['about_visi'] ?? null; @endphp
        @if($aboutVisi)
        <section>
            <h2 class="text-2xl font-black text-gray-800 uppercase tracking-tight mb-4 border-l-4 border-primary pl-4">
                Visi
            </h2>
            <div class="bg-gray-50 border border-gray-100 rounded-2xl p-6">
                <p class="text-gray-700 leading-relaxed text-base font-medium italic">
                    "{{ $aboutVisi }}"
                </p>
            </div>
        </section>
        @endif

        {{-- ── MISI ── --}}
        @php
            $aboutMisi = $settings['about_misi'] ?? null;
            $misiLines = $aboutMisi ? array_filter(array_map('trim', explode("\n", $aboutMisi))) : [];
        @endphp
        @if(count($misiLines) > 0)
        <section>
            <h2 class="text-2xl font-black text-gray-800 uppercase tracking-tight mb-4 border-l-4 border-primary pl-4">
                Misi
            </h2>
            <div class="space-y-3">
                @foreach($misiLines as $i => $misi)
                <div class="flex items-start gap-4 p-4 bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-md hover:border-primary/20 transition-all group">
                    <span class="shrink-0 w-8 h-8 rounded-full bg-primary text-white text-[11px] font-black flex items-center justify-center shadow-sm shadow-primary/30 group-hover:scale-105 transition-transform">
                        {{ $i + 1 }}
                    </span>
                    <p class="text-gray-700 leading-relaxed text-sm font-medium pt-1">{{ $misi }}</p>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        {{-- ── KONTAK ── --}}
        @php
            $aboutAlamat   = $settings['about_alamat']   ?? null;
            $aboutWhatsapp = $settings['about_whatsapp'] ?? null;
            $aboutEmail    = $settings['about_email']    ?? null;
            $hasContact    = $aboutAlamat || $aboutWhatsapp || $aboutEmail;
        @endphp
        @if($hasContact)
        <section>
            <h2 class="text-2xl font-black text-gray-800 uppercase tracking-tight mb-6 border-l-4 border-primary pl-4">
                Kontak
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                {{-- Alamat --}}
                @if($aboutAlamat)
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all group">
                    <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </div>
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Alamat</p>
                    <p class="text-gray-800 font-bold text-sm leading-relaxed">{{ $aboutAlamat }}</p>
                </div>
                @endif

                {{-- WhatsApp --}}
                @if($aboutWhatsapp)
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all group">
                    <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.18L6.52 2a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 9a16 16 0 0 0 6 6l.86-.87a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 21.46 16l-.54.92z"/>
                        </svg>
                    </div>
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">WhatsApp</p>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $aboutWhatsapp) }}"
                       target="_blank"
                       class="text-gray-800 font-bold text-sm hover:text-green-600 transition-colors">
                        {{ $aboutWhatsapp }}
                    </a>
                </div>
                @endif

                {{-- Email --}}
                @if($aboutEmail)
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all group">
                    <div class="w-10 h-10 bg-red-50 rounded-xl flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </div>
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Email</p>
                    <a href="mailto:{{ $aboutEmail }}"
                       class="text-gray-800 font-bold text-sm hover:text-primary transition-colors break-all">
                        {{ $aboutEmail }}
                    </a>
                </div>
                @endif

            </div>
        </section>
        @endif


    </div>{{-- /space-y-12 --}}
</div>
@endsection
