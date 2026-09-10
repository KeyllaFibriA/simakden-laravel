<x-app-layout>

    <x-slot name="header">

        <div>

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Publikasi
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Dosen: {{ $dosen->nama_dosen }}
            </p>

        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Error --}}
            @if ($errors->any())

                <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">

                    <div class="font-semibold mb-2">
                        Terjadi kesalahan:
                    </div>

                    <ul class="list-disc list-inside">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif


            <div class="bg-white shadow-sm rounded-lg p-8">

                <form
                    method="POST"
                    action="{{ route('dosen.publikasi.update', $publikasi->id) }}"
                >

                    @csrf

                    @method('PUT')


                    {{-- Judul --}}
                    <div class="mb-6">

                        <label
                            for="judul"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Judul Publikasi <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="judul"
                            name="judul"
                            value="{{ old('judul', $publikasi->judul) }}"
                            required
                            placeholder="Masukkan judul publikasi"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        >

                    </div>


                    {{-- Jenis --}}
                    <div class="mb-6">

                        <label
                            for="jenis"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Jenis Publikasi
                        </label>

                        <select
                            id="jenis"
                            name="jenis"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        >

                            <option value="">
                                -- Pilih Jenis --
                            </option>

                            <option
                                value="Jurnal"
                                {{ old('jenis', $publikasi->jenis) == 'Jurnal' ? 'selected' : '' }}
                            >
                                Jurnal
                            </option>

                            <option
                                value="Prosiding"
                                {{ old('jenis', $publikasi->jenis) == 'Prosiding' ? 'selected' : '' }}
                            >
                                Prosiding
                            </option>

                            <option
                                value="Buku"
                                {{ old('jenis', $publikasi->jenis) == 'Buku' ? 'selected' : '' }}
                            >
                                Buku
                            </option>

                            <option
                                value="Book Chapter"
                                {{ old('jenis', $publikasi->jenis) == 'Book Chapter' ? 'selected' : '' }}
                            >
                                Book Chapter
                            </option>

                            <option
                                value="Lainnya"
                                {{ old('jenis', $publikasi->jenis) == 'Lainnya' ? 'selected' : '' }}
                            >
                                Lainnya
                            </option>

                        </select>

                    </div>


                    {{-- Tahun --}}
                    <div class="mb-6">

                        <label
                            for="tahun"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Tahun
                        </label>

                        <input
                            type="number"
                            id="tahun"
                            name="tahun"
                            value="{{ old('tahun', $publikasi->tahun) }}"
                            min="1900"
                            max="2100"
                            placeholder="Contoh: 2026"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        >

                    </div>


                    {{-- Jurnal --}}
                    <div class="mb-6">

                        <label
                            for="jurnal"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Nama Jurnal / Penerbit
                        </label>

                        <input
                            type="text"
                            id="jurnal"
                            name="jurnal"
                            value="{{ old('jurnal', $publikasi->jurnal) }}"
                            placeholder="Masukkan nama jurnal atau penerbit"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        >

                    </div>


                    {{-- URL --}}
                    <div class="mb-6">

                        <label
                            for="url"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            URL Publikasi
                        </label>

                        <input
                            type="url"
                            id="url"
                            name="url"
                            value="{{ old('url', $publikasi->url) }}"
                            placeholder="https://contoh.com/publikasi"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        >

                    </div>


                    {{-- DOI --}}
                    <div class="mb-8">

                        <label
                            for="doi"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            DOI
                        </label>

                        <input
                            type="text"
                            id="doi"
                            name="doi"
                            value="{{ old('doi', $publikasi->doi) }}"
                            placeholder="Contoh: 10.1234/xxxxx"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        >

                    </div>


                    {{-- Tombol --}}
                    <div class="flex items-center justify-between">

                        <a
                            href="{{ route('dosen.publikasi.index') }}"
                            class="text-sm text-gray-600 hover:text-gray-900"
                        >
                            ← Kembali
                        </a>


                        <button
                            type="submit"
                            style="background-color:#2563eb;color:white;padding:10px 20px;border-radius:8px;border:none;font-weight:bold;cursor:pointer;"
                        >
                            Update Publikasi
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>