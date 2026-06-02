@extends('layouts.admin')

@section('title', 'Tim Redaksi')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <div class="flex items-center gap-3 mb-2">
            <div class="h-0.5 w-8 bg-red-600"></div>
            <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Tim Redaksi</h1>
        </div>
        <div class="flex items-center gap-2 text-[10px] font-bold text-gray-400 uppercase ml-11">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-red-500 transition-colors">Home</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
            <span class="text-red-500">Tim Redaksi</span>
        </div>
    </div>
    <a href="{{ route('admin.editorial-teams.create') }}" class="flex items-center gap-2 bg-gray-900 text-white px-4 py-2.5 rounded-lg text-[10px] font-black uppercase tracking-widest hover:bg-gray-800 transition-colors shadow-sm active:scale-95">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Anggota
    </a>
</div>


<div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest">Foto</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest">Nama & Jabatan</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest">Keterangan</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest w-32 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($teams as $team)
                <tr class="hover:bg-gray-50/50 transition-colors group">
                    <td class="px-6 py-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-100 border-2 border-white shadow-sm flex items-center justify-center">
                            @if($team->photo)
                                <img src="{{ Storage::url($team->photo) }}" alt="{{ $team->name }}" class="w-full h-full object-cover">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-300 w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-bold text-gray-900 mb-0.5">{{ $team->name }}</div>
                        <div class="text-[10px] font-black text-red-500 uppercase tracking-widest">{{ $team->role }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-xs text-gray-500 font-medium">{{ $team->description ?? '-' }}</div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2 transition-opacity">
                            <a href="{{ route('admin.editorial-teams.edit', $team->id) }}" class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </a>
                            <form action="{{ route('admin.editorial-teams.destroy', $team->id) }}" method="POST" class="inline-block delete-form" data-confirm="Yakin ingin menghapus anggota redaksi ini?">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mb-4 opacity-50"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            <p class="text-sm font-bold mb-1 text-gray-500">Belum ada data anggota redaksi</p>
                            <p class="text-[11px] font-medium">Klik tombol "Tambah Anggota" untuk memulai</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
