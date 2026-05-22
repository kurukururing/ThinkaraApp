@extends('layout.app') {{-- Sesuaikan nama layout milik Anda --}}

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Pembahasan Latihan</h1>
        <a href="{{ route('arena') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition shadow-sm">
            Kembali ke Arena
        </a>
    </div>

    <!-- Alert Status Benar / Salah -->
    <div class="p-4 mb-6 rounded-lg border-l-4 shadow-sm {{ $pembahasanData['is_correct'] ? 'bg-green-50 border-green-500' : 'bg-red-50 border-red-500' }}">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                @if($pembahasanData['is_correct'])
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                @else
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                @endif
            </div>
            <div class="ml-3">
                <h3 class="text-lg font-medium {{ $pembahasanData['is_correct'] ? 'text-green-800' : 'text-red-800' }}">
                    {{ $pembahasanData['is_correct'] ? 'Jawaban Kamu Tepat!' : 'Masih Kurang Tepat!' }}
                </h3>
                <p class="mt-1 text-sm {{ $pembahasanData['is_correct'] ? 'text-green-700' : 'text-red-700' }}">
                    {{ $pembahasanData['message'] }}
                </p>
            </div>
        </div>
    </div>

    <!-- Konteks Soal -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100">
        <h2 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-2">Konteks Topik: {{ $soal->topik }}</h2>
        <p class="text-gray-700 leading-relaxed text-justify">
            {{ $soal->isi_soal }}
        </p>
    </div>

    <!-- Bagian Pembahasan Jawaban -->
    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Kunci Jawaban & Penjelasan
        </h2>

        @if($pembahasanData['type'] === 'builder')
            <div class="space-y-4 mt-4">
                <p class="text-gray-600 mb-4">Berikut adalah susunan argumen logis yang benar secara struktural:</p>
                
                @foreach($kunciBuilder as $index => $item)
                    <div class="flex items-start bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <div class="flex-shrink-0 mt-1">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-800 font-bold text-sm">
                                {{ $index + 1 }}
                            </span>
                        </div>
                        <div class="ml-4 w-full">
                            <span class="inline-block px-2 py-1 bg-gray-200 text-gray-800 text-xs font-semibold rounded uppercase tracking-wider mb-2">
                                {{ $item->tipe }}
                            </span>
                            <p class="text-gray-800">
                                {{ $item->isi_item }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

        @elseif($pembahasanData['type'] === 'fallacy')
            <div class="mt-4">
                <p class="text-gray-600 mb-4">Kecacatan logika (Logical Fallacy) yang tepat dari argumen di atas adalah:</p>
                @if($kunciFallacy)
                    <div class="bg-indigo-50 border-l-4 border-indigo-500 p-5 rounded-r-lg">
                        <h3 class="text-lg font-bold text-indigo-900 mb-2 uppercase">{{ $kunciFallacy->jenis_kesalahan }}</h3>
                        <p class="text-indigo-800">
                            Menentukan <strong>{{ $kunciFallacy->jenis_kesalahan }}</strong> sangat penting dalam membedah sebuah argumen untuk menemukan di mana letak kelemahan klaim yang disodorkan.
                        </p>
                    </div>
                @else
                    <p class="text-red-500 italic">Data kunci fallacy belum tersedia untuk soal ini.</p>
                @endif
            </div>
        @endif

    </div>
</div>
@endsection