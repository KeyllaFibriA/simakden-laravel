<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Data Publikasi
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Dosen: {{ $dosen->nama_dosen }}
                </p>
            </div>

            <a
                href="{{ route('admin.dosen.publikasi.create', $dosen->id_dosen) }}"
                style="background-color:#2563eb;color:white;padding:10px 18px;border-radius:8px;text-decoration:none;font-weight:bold;"
            >
                + Tambah Publikasi
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">

                @if ($publikasi->count() > 0)

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">

                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-6 py-4">No</th>
                                    <th class="px-6 py-4">Judul</th>
                                    <th class="px-6 py-4">Jenis</th>
                                    <th class="px-6 py-4">Tahun</th>
                                    <th class="px-6 py-4">Jurnal</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">

                                @foreach ($publikasi as $item)

                                    <tr class="hover:bg-gray-50">

                                        <td class="px-6 py-4">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="font-semibold text-gray-800">
                                                {{ $item->judul }}
                                            </div>

                                            @if ($item->doi)
                                                <div class="text-xs text-gray-500 mt-1">
                                                    DOI: {{ $item->doi }}
                                                </div>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4">
                                            {{ $item->jenis ?? '-' }}
                                        </td>

                                        <td class="px-6 py-4">
                                            {{ $item->tahun ?? '-' }}
                                        </td>

                                        <td class="px-6 py-4">
                                            {{ $item->jurnal ?? '-' }}
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex justify-center gap-2">
                                                @if ($item->file)
        <a
            href="{{ asset('storage/' . $item->file) }}"
            target="_blank"
            style="background-color:#16a34a;color:white;padding:7px 12px;border-radius:6px;text-decoration:none;"
        >
            📄 Lihat PDF
        </a>
    @endif

    <a
        href="{{ route('admin.dosen.publikasi.edit', [$dosen->id_dosen, $item->id]) }}"
        style="background-color:#f59e0b;color:white;padding:7px 12px;border-radius:6px;text-decoration:none;"
    >
        Edit
    </a>
                                                <a
                                                    href="{{ route('admin.dosen.publikasi.edit', [$dosen->id_dosen, $item->id]) }}"
                                                    style="background-color:#f59e0b;color:white;padding:7px 12px;border-radius:6px;text-decoration:none;"
                                                >
                                                    Edit
                                                </a>

                                                <form
                                                    method="POST"
                                                    action="{{ route('admin.dosen.publikasi.destroy', [$dosen->id_dosen, $item->id]) }}"
                                                    onsubmit="return confirm('Yakin ingin menghapus publikasi ini?');"
                                                >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        style="background-color:#dc2626;color:white;padding:7px 12px;border-radius:6px;border:none;cursor:pointer;"
                                                    >
                                                        Hapus
                                                    </button>
                                                </form>

                                            </div>
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>
                    </div>

                @else

                    <div class="p-10 text-center">

                        <h3 class="text-lg font-semibold text-gray-700">
                            Belum ada data publikasi
                        </h3>

                        <p class="text-sm text-gray-500 mt-1 mb-5">
                            Silakan tambahkan publikasi ilmiah dosen.
                        </p>

                        <a
                            href="{{ route('admin.dosen.publikasi.create', $dosen->id_dosen) }}"
                            style="background-color:#2563eb;color:white;padding:10px 18px;border-radius:8px;text-decoration:none;font-weight:bold;"
                        >
                            + Tambah Publikasi
                        </a>

                    </div>

                @endif

            </div>

            <div class="mt-6">
                <a
                    href="{{ route('admin.dosen.show', $dosen->id_dosen) }}"
                    class="text-sm text-gray-600 hover:text-gray-900"
                >
                    ← Kembali ke Detail Dosen
                </a>
            </div>

        </div>
    </div>
</x-app-layout>