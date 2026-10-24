<x-admin-layout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
        {{ $title }}
    </h2>

    <!-- Flash Message Notifikasi Sukses -->
    @if (session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-sm" role="alert">
            <span class="block sm:inline font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="shadow px-6 py-4 bg-white rounded sm:px-1 sm:py-1">
        <!-- Bagian Tombol Aksi & Search -->
        <div class="grid grid-cols-1 md:grid-cols-2 p-4 gap-4">
            <div>
                <a href="{{ route('products.create') }}">
                    <button class="px-4 py-1 text-sm rounded text-purple-600 font-semibold border border-purple-200 hover:text-white hover:bg-purple-600 focus:outline-none">Tambah Produk</button>
                </a>
            </div>
            <div class="flex justify-end">
                <form action="{{ route('products.index') }}" method="GET" class="flex">
                    <!-- Filter Kategori -->
                    <select name="category_id" class="block py-2 px-3 border border-gray-300 bg-white rounded-l-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->category_id }}" {{ (isset($_GET['category_id']) && $_GET['category_id'] == $cat->category_id) ? 'selected' : '' }}>
                                {{ $cat->category }}
                            </option>
                        @endforeach
                    </select>
                    <!-- Input Search -->
                    <input type="text" name="s" value="{{ isset($_GET['s']) ? $_GET['s'] : '' }}" placeholder="Cari produk..." class="px-4 py-2 border-t border-b border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <button type="submit" class="rounded-r-md border px-4 py-1 border-gray-300 bg-gray-50 text-blue-600 hover:text-white hover:bg-blue-600 text-sm font-semibold">
                        Cari
                    </button>
                </form>
            </div>
        </div>

        <!-- Tabel Daftar Produk -->
        <div class="py-2 align-middle inline-block min-w-full sm:px-4 lg:px-4">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga & Stok</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($products as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $item->name }}</div>
                                <div class="text-sm text-gray-500">Slug: {{ $item->slug }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->category ? $item->category->category : 'Tanpa Kategori' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                                <div class="text-sm text-gray-500">Stok: {{ $item->stock }} unit</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form action="{{ route('products.destroy', $item->product_id) }}" method="POST">
                                    @csrf 
                                    @method('DELETE')
                                    <a href="{{ route('products.edit', $item->product_id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                    <button class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')" type="submit">Del</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination dengan Query Search & Filter -->
        <div class="m-4">
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>
</x-admin-layout>