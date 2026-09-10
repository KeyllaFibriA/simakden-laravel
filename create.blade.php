<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tambah Publikasi
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Dosen: {{ $dosen->nama_dosen }}
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-lg font-semibold text-gray-800 mb-6">
                    Form Data Publikasi
                </h3>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                        <ul class="list-disc ml-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form
                    method="POST"
    action="{{ route('admin.dosen.publikasi.store', $dosen->id_dosen) }}"
    enctype="multipart/form-data"
                >
                    @csrf

                    {{-- Judul --}}
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Judul Publikasi <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="judul"
                            value="{{ old('judul') }}"
                            required
                            placeholder="Masukkan judul publikasi"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>

                    {{-- Jenis --}}
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Jenis Publikasi
                        </label>

                        <select
                            name="jenis"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Jurnal" {{ old('jenis') == 'Jurnal' ? 'selected' : '' }}>
                                Jurnal
                            </option>
                            <option value="Prosiding" {{ old('jenis') == 'Prosiding' ? 'selected' : '' }}>
                                Prosiding
                            </option>
                            <option value="Buku" {{ old('jenis') == 'Buku' ? 'selected' : '' }}>
                                Buku
                            </option>
                            <option value="Book Chapter" {{ old('jenis') == 'Book Chapter' ? 'selected' : '' }}>
                                Book Chapter
                            </option>
                            <option value="Artikel" {{ old('jenis') == 'Artikel' ? 'selected' : '' }}>
                                Artikel
                            </option>
                        </select>
                    </div>

                    {{-- Tahun --}}
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Tahun
                        </label>

                        <input
                            type="text"
                            name="tahun"
                            value="{{ old('tahun') }}"
                            placeholder="Contoh: 2026"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>

                    {{-- Jurnal --}}
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Jurnal / Penerbit
                        </label>

                        <input
                            type="text"
                            name="jurnal"
                            value="{{ old('jurnal') }}"
                            placeholder="Contoh: Jurnal Teknologi Informasi"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>

                    {{-- URL --}}
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            URL Publikasi
                        </label>

                        <input
                            type="text"
                            name="url"
                            value="{{ old('url') }}"
                            placeholder="https://..."
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>

                    {{-- DOI --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            DOI
                        </label>

                        <input
                            type="text"
                            name="doi"
                            value="{{ old('doi') }}"
                            placeholder="Contoh: 10.xxxx/xxxxx"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>

{{-- File Publikasi --}}
<div class="mb-6">
    <label class="block text-sm font-medium text-gray-700 mb-1">
        Upload File Publikasi (PDF)
    </label>

    <input
        type="file"
        name="file"
        accept=".pdf,application/pdf"
        class="w-full border border-gray-300 rounded-lg shadow-sm p-2 bg-white focus:ring-blue-500 focus:border-blue-500"
    >

    <p class="text-xs text-gray-500 mt-1">
        Format PDF, maksimal 10 MB.
    </p>
</div>
                    {{-- Tombol --}}
                    <div class="flex items-center justify-end gap-3">

                        <a
                            href="{{ route('admin.dosen.show', $dosen->id_dosen) }}"
                            style="background-color:#e5e7eb;color:#374151;padding:10px 20px;border-radius:8px;text-decoration:none;"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            style="background-color:#2563eb;color:#ffffff;padding:10px 20px;border-radius:8px;border:none;font-weight:bold;cursor:pointer;"
                        >
                            Simpan Publikasi
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>