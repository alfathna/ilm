@extends('layouts.admin')

@section('title', 'Tema')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-10">
        <div class="flex items-center gap-4 mb-2">
            <div class="h-0.5 w-12 bg-red-600"></div>
            <h1 class="text-3xl font-black text-gray-900 uppercase tracking-tighter">Tema Website</h1>
        </div>
        <div class="flex items-center gap-2 text-[11px] font-bold text-gray-400 uppercase ml-16">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-red-500 transition-colors">Home</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
            <span class="text-red-500">Modul Web &bull; Tema</span>
        </div>
        <p class="mt-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-16">Pilih warna dasar yang akan diterapkan langsung di halaman utama web</p>
    </div>


    @if($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl text-sm font-bold">
        {{ $errors->first() }}
    </div>
    @endif

    <form id="tema-form" action="{{ route('admin.web.tema.save') }}" method="POST">
        @csrf
        <input type="hidden" name="theme_color" id="selected-color" value="{{ $activeColor }}">

        <div class="space-y-4" id="theme-cards">
            @foreach($themes as $theme)
            <div
                class="theme-card bg-white rounded-2xl border-2 shadow-sm p-6 flex flex-col md:flex-row items-center justify-between gap-6 cursor-pointer select-none transition-all duration-200"
                data-color="{{ $theme['color'] }}"
                data-class="{{ $theme['class'] }}"
                onclick="selectTheme(this)"
                style="border-color: {{ $activeColor === $theme['color'] ? $theme['color'] : '#e5e7eb' }};
                       {{ $activeColor === $theme['color'] ? 'box-shadow: 0 0 0 3px ' . $theme['color'] . '33;' : '' }}"
            >
                <div class="flex items-center gap-6">
                    {{-- Color Swatch --}}
                    <div
                        class="theme-swatch w-14 h-14 rounded-2xl shadow-inner flex items-center justify-center transition-transform duration-200"
                        style="background-color: {{ $theme['color'] }}; {{ $activeColor === $theme['color'] ? 'transform: scale(1.1)' : '' }}"
                    >
                        {{-- Checkmark icon, shown when active --}}
                        <svg
                            class="theme-check transition-all duration-200"
                            style="opacity: {{ $activeColor === $theme['color'] ? '1' : '0' }}; transform: scale({{ $activeColor === $theme['color'] ? '1' : '0' }});"
                            xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                            fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">Warna Dasar {{ $theme['name'] }}</h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-0.5">{{ $theme['color'] }}</p>
                        <span
                            class="theme-badge inline-block mt-1 text-[9px] font-black uppercase px-2 py-0.5 rounded-full tracking-wider transition-all duration-200"
                            style="background: {{ $activeColor === $theme['color'] ? $theme['color'] . '22' : 'transparent' }};
                                   color: {{ $activeColor === $theme['color'] ? $theme['color'] : 'transparent' }};"
                        >✓ Aktif</span>
                    </div>
                </div>

                <div class="text-[10px] font-black text-gray-300 uppercase tracking-widest theme-hint hidden md:block">
                    Klik untuk pilih
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8 flex items-center justify-between">
            <p id="selected-label" class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                Warna aktif: <span class="font-black text-gray-700">{{ collect($themes)->firstWhere('color', $activeColor)['name'] ?? '-' }}</span>
            </p>
            <button
                type="submit"
                id="save-btn"
                class="px-12 py-3 bg-gray-900 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-neutral-800 transition-all shadow-lg active:scale-95"
            >
                Simpan Tema
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Theme data passed from PHP
    var themes = @json($themes);
    var currentActive = '{{ $activeColor }}';

    function selectTheme(card) {
        var color = card.getAttribute('data-color');
        var theme = themes.find(function(t) { return t.color === color; });
        if (!theme) return;

        // Update hidden input
        document.getElementById('selected-color').value = color;

        // Reset all cards
        document.querySelectorAll('.theme-card').forEach(function(c) {
            var cColor = c.getAttribute('data-color');
            var cTheme = themes.find(function(t) { return t.color === cColor; });

            // Reset border
            c.style.borderColor = '#e5e7eb';
            c.style.boxShadow = '';
            c.style.transform = '';

            // Reset swatch
            var swatch = c.querySelector('.theme-swatch');
            swatch.style.transform = '';

            // Hide checkmark
            var check = c.querySelector('.theme-check');
            check.style.opacity = '0';
            check.style.transform = 'scale(0)';

            // Hide badge
            var badge = c.querySelector('.theme-badge');
            badge.style.background = 'transparent';
            badge.style.color = 'transparent';
        });

        // Activate clicked card with animation
        card.style.borderColor = color;
        card.style.boxShadow = '0 0 0 3px ' + color + '33';

        // Pop animation on swatch
        var swatch = card.querySelector('.theme-swatch');
        swatch.style.transform = 'scale(1.15)';
        setTimeout(function() { swatch.style.transform = 'scale(1.08)'; }, 150);

        // Show checkmark with scale animation
        var check = card.querySelector('.theme-check');
        check.style.opacity = '1';
        check.style.transform = 'scale(1)';

        // Show badge
        var badge = card.querySelector('.theme-badge');
        badge.style.background = color + '22';
        badge.style.color = color;

        // Card ripple — brief scale bump
        card.style.transform = 'scale(1.01)';
        setTimeout(function() { card.style.transform = ''; }, 150);

        // Update label
        var label = document.getElementById('selected-label');
        label.querySelector('span').textContent = theme.name;

        // Highlight save button with selected color
        var btn = document.getElementById('save-btn');
        btn.style.background = color;
        btn.style.boxShadow = '0 8px 24px ' + color + '55';
        btn.style.transition = 'background 0.3s, box-shadow 0.3s';
    }

    // Auto-dismiss flash message after 3s
    var flash = document.getElementById('flash-msg');
    if (flash) {
        setTimeout(function() {
            flash.style.transition = 'opacity 0.5s';
            flash.style.opacity = '0';
            setTimeout(function() { flash.remove(); }, 500);
        }, 3000);
    }
</script>
@endpush
@endsection
