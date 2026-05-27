@extends('layout.app')
@section('page_title', 'Papan Peringkat')

@section('content')
<div class="max-w-5xl mx-auto pb-10">

    {{-- Header & Filter --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
        <div>
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Top Thinkers 🏆</h2>
            <p class="text-sm text-slate-500 font-medium mt-1">Data performa berdasarkan pemikiran kritis.</p>
        </div>
        
        <div class="flex flex-col sm:flex-row items-center gap-3">
            <input type="text" id="searchInput" placeholder="Cari ..." class="w-full sm:w-56 px-5 py-2.5 bg-white border border-slate-100 rounded-xl text-sm font-semibold text-slate-600 focus:outline-none focus:border-[#7c3aed] focus:ring-1 focus:ring-[#7c3aed] transition-all placeholder:text-slate-400 shadow-sm">
            <button id="btnSortSkor" class="px-5 py-2.5 text-sm font-bold bg-[#7c3aed] text-white rounded-xl shadow-sm shadow-[#7c3aed]/20 hover:bg-[#6d28d9] transition-all whitespace-nowrap">Skor Tertinggi</button>
            <button id="btnSortXp" class="px-5 py-2.5 text-sm font-bold bg-white text-slate-600 border border-slate-100 rounded-xl shadow-sm hover:bg-slate-50 transition-all whitespace-nowrap">XP Tertinggi</button>
        </div>
    </div>

    {{-- Tabel Peringkat --}}
    <div class="bg-white rounded-[1.5rem] shadow-sm border border-slate-100 mb-8 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left min-w-[800px]">
                <thead>
                    <tr class="text-[10px] text-slate-400 font-black uppercase tracking-widest border-b border-slate-50">
                        <th class="py-5 px-8 w-16">#</th>
                        <th class="py-5 px-6">PLAYER</th>
                        <th class="py-5 px-6 text-center">XP</th>
                        <th class="py-5 px-6 text-center">SKOR</th>
                    </tr>
                </thead>
                <tbody id="leaderboardBody" class="text-sm font-black text-slate-700">
                    
                    @forelse($leaderboard as $index => $user)
                        <tr class="leaderboard-row border-b border-slate-50 hover:bg-slate-50/50 transition-colors" data-skor="{{ $user->total_skor }}" data-xp="{{ $user->total_xp }}" data-nama="{{ strtolower($user->nama_mahasiswa) }}">
                            <td class="rank-col py-5 px-8 {{ $index == 0 ? 'text-[#eab308]' : 'text-slate-400' }} text-lg">{{ $index + 1 }}</td>
                            <td class="py-5 px-6 flex items-center gap-4">
                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ urlencode($user->nama_mahasiswa) }}" class="w-10 h-10 rounded-full bg-slate-50">
                                <span class="text-base text-slate-800">{{ $user->nama_mahasiswa }}</span>
                            </td>
                            <td class="py-5 px-6 text-center text-slate-600">{{ $user->total_xp }}</td>
                            <td class="py-5 px-6 text-center text-slate-600">{{ $user->total_skor }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-slate-500 font-semibold">Belum ada data pengerjaan latihan yang tercatat.</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

    {{-- Bottom Bar Peringkat Kamu --}}
    <div class="relative bg-[#fbf9ff] border border-[#ede3ff] rounded-2xl p-6 md:px-8 flex flex-col md:flex-row items-center justify-between shadow-sm mt-10">
        
        {{-- Badge Peringkat Kamu --}}
        <div class="absolute -top-3 left-6 bg-[#7c3aed] text-white text-[9px] font-black uppercase tracking-widest px-3 py-1.5 rounded-full shadow-sm">
            PERINGKAT KAMU
        </div>

        <div class="flex items-center gap-6 mt-2 md:mt-0 w-full md:w-auto">
            <span class="text-[#a78bfa] font-black text-xl">{{ $currentUserRank ?? '-' }}</span>
            <div class="flex items-center gap-4">
                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ urlencode(Auth::user()->mahasiswa->nama_mahasiswa ?? Auth::user()->username) }}" class="w-12 h-12 rounded-full bg-white border border-[#ede3ff]">
                <div class="flex flex-col">
                    <span class="text-base font-black text-[#6d28d9] leading-tight">{{ Auth::user()->mahasiswa->nama_mahasiswa ?? Auth::user()->username }}</span>
                    <span class="text-[10px] text-[#8b5cf6] font-bold uppercase tracking-widest mt-0.5">PEMULA LV. 1</span>
                </div>
            </div>
        </div>
        
        <div class="flex items-center justify-end gap-12 w-full md:w-auto mt-4 md:mt-0 pr-4">
            <div class="text-center">
                <p class="text-[10px] font-black text-[#a78bfa] uppercase tracking-widest mb-1">SKOR</p>
                <p class="text-xl font-black text-[#6d28d9] leading-none">{{ $currentUserData ? $currentUserData->total_skor : 0 }}</p>
            </div>
            <div class="text-center">
                <p class="text-[10px] font-black text-[#a78bfa] uppercase tracking-widest mb-1">XP</p>
                <p class="text-xl font-black text-[#6d28d9] leading-none">{{ $currentUserData ? $currentUserData->total_xp : 0 }}</p>
            </div>
        </div>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const btnSortSkor = document.getElementById('btnSortSkor');
        const btnSortXp = document.getElementById('btnSortXp');
        const leaderboardBody = document.getElementById('leaderboardBody');
        
        const rows = Array.from(document.querySelectorAll('.leaderboard-row'));
        if (rows.length === 0) return; // Hentikan script jika belum ada data baris
        
        // Fungsi untuk memperbarui angka peringkat secara dinamis
        function updateRanks() {
            const visibleRows = rows.filter(row => row.style.display !== 'none');
            visibleRows.forEach((row, index) => {
                const rankCol = row.querySelector('.rank-col');
                rankCol.textContent = index + 1;
                
                // Set warna kuning (gold) untuk peringkat pertama
                rankCol.className = index === 0 
                    ? 'rank-col py-5 px-8 text-[#eab308] text-lg' 
                    : 'rank-col py-5 px-8 text-slate-400 text-lg';
            });
        }
        
        // Fungsionalitas pencarian nama player (case-insensitive)
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            rows.forEach(row => {
                const nama = row.getAttribute('data-nama');
                row.style.display = nama.includes(query) ? '' : 'none';
            });
            updateRanks();
        });
        
        // Fungsi reusable untuk menyortir data (skor atau xp)
        function sortData(sortBy) {
            rows.sort((a, b) => {
                const valA = parseInt(a.getAttribute(`data-${sortBy}`));
                const valB = parseInt(b.getAttribute(`data-${sortBy}`));
                // Fallback untuk tiebreaker
                const secA = parseInt(a.getAttribute(sortBy === 'skor' ? 'data-xp' : 'data-skor'));
                const secB = parseInt(b.getAttribute(sortBy === 'skor' ? 'data-xp' : 'data-skor'));
                
                return valB !== valA ? valB - valA : secB - secA;
            });
            
            rows.forEach(row => leaderboardBody.appendChild(row));
            updateRanks();
        }

        btnSortSkor.addEventListener('click', function() {
            btnSortSkor.className = 'px-5 py-2.5 text-sm font-bold bg-[#7c3aed] text-white rounded-xl shadow-sm shadow-[#7c3aed]/20 hover:bg-[#6d28d9] transition-all whitespace-nowrap';
            btnSortXp.className = 'px-5 py-2.5 text-sm font-bold bg-white text-slate-600 border border-slate-100 rounded-xl shadow-sm hover:bg-slate-50 transition-all whitespace-nowrap';
            sortData('skor');
        });
        
        btnSortXp.addEventListener('click', function() {
            btnSortXp.className = 'px-5 py-2.5 text-sm font-bold bg-[#7c3aed] text-white rounded-xl shadow-sm shadow-[#7c3aed]/20 hover:bg-[#6d28d9] transition-all whitespace-nowrap';
            btnSortSkor.className = 'px-5 py-2.5 text-sm font-bold bg-white text-slate-600 border border-slate-100 rounded-xl shadow-sm hover:bg-slate-50 transition-all whitespace-nowrap';
            sortData('xp');
        });
    });
</script>
@endsection