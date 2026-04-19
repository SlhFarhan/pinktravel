<x-admin-layout title="Edit Trip" active="trips">

    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition">Dashboard</a>
        <span>/</span>
        <span class="text-gray-300">Edit: {{ Str::limit($trip->title, 40) }}</span>
    </nav>

    <form method="POST" action="{{ route('admin.trips.update', $trip->id) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- ── Kiri ─────────────────────────────────────────────── --}}
            <div class="xl:col-span-2 space-y-5">

                <div class="bg-gray-900 border border-white/5 rounded-2xl p-6">
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-5">Informasi Trip</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1.5">Judul Trip <span class="text-pink-500">*</span></label>
                            <input type="text" name="title" value="{{ old('title', $trip->title) }}"
                                   class="w-full px-4 py-3 bg-gray-800 border border-white/10 rounded-xl text-white focus:outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500 transition" required>
                            @error('title')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1.5">Kota Keberangkatan <span class="text-pink-500">*</span></label>
                                <input type="text" name="departure_city" value="{{ old('departure_city', $trip->departure_city) }}"
                                       class="w-full px-4 py-3 bg-gray-800 border border-white/10 rounded-xl text-white focus:outline-none focus:border-pink-500 transition" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1.5">Destinasi <span class="text-pink-500">*</span></label>
                                <input type="text" name="destination" value="{{ old('destination', $trip->destination) }}"
                                       class="w-full px-4 py-3 bg-gray-800 border border-white/10 rounded-xl text-white focus:outline-none focus:border-pink-500 transition" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1.5">Deskripsi <span class="text-pink-500">*</span></label>
                            <textarea name="description" rows="3"
                                      class="w-full px-4 py-3 bg-gray-800 border border-white/10 rounded-xl text-white focus:outline-none focus:border-pink-500 transition resize-none" required>{{ old('description', $trip->description) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1.5">Overview <span class="text-pink-500">*</span></label>
                            <textarea name="overview" rows="4"
                                      class="w-full px-4 py-3 bg-gray-800 border border-white/10 rounded-xl text-white focus:outline-none focus:border-pink-500 transition resize-none" required>{{ old('overview', $trip->overview) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-900 border border-white/5 rounded-2xl p-6">
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Titik Kumpul</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1.5">Nama Titik Kumpul</label>
                            <input type="text" name="meeting_point" value="{{ old('meeting_point', $trip->meeting_point) }}"
                                   class="w-full px-4 py-3 bg-gray-800 border border-white/10 rounded-xl text-white focus:outline-none focus:border-pink-500 transition" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1.5">Alamat Lengkap</label>
                            <input type="text" name="meeting_address" value="{{ old('meeting_address', $trip->meeting_address) }}"
                                   class="w-full px-4 py-3 bg-gray-800 border border-white/10 rounded-xl text-white focus:outline-none focus:border-pink-500 transition" required>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ── Kanan ────────────────────────────────────────────── --}}
            <div class="space-y-5">

                {{-- Gambar --}}
                <div class="bg-gray-900 border border-white/5 rounded-2xl p-6">
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Foto Trip</h3>
                    <div class="relative rounded-xl overflow-hidden bg-gray-800 cursor-pointer group"
                         onclick="document.getElementById('imageInput').click()">
                        @if($trip->image)
                            <img id="imagePreview" src="{{ $trip->image }}" alt="{{ $trip->title }}"
                                 class="w-full h-44 object-cover">
                        @else
                            <div id="imagePreview" class="w-full h-44 flex items-center justify-center bg-gray-800">
                                <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition">
                            <p class="text-white text-sm font-medium">🖼 Ganti Foto</p>
                        </div>
                    </div>
                    <input type="file" id="imageInput" name="image" accept="image/*" class="hidden"
                           onchange="previewImage(this)">
                    <p class="text-xs text-gray-600 mt-2 text-center">Biarkan kosong untuk mempertahankan foto lama</p>
                    @error('image')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Harga & Kapasitas --}}
                <div class="bg-gray-900 border border-white/5 rounded-2xl p-6">
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Harga & Kapasitas</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1.5">Harga per Orang (Rp) <span class="text-pink-500">*</span></label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">Rp</span>
                                <input type="number" name="price" value="{{ old('price', $trip->price) }}" min="0"
                                       class="w-full pl-10 pr-4 py-3 bg-gray-800 border border-white/10 rounded-xl text-white focus:outline-none focus:border-pink-500 transition" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1.5">Durasi (Hari) <span class="text-pink-500">*</span></label>
                            <input type="number" name="duration_days" value="{{ old('duration_days', $trip->duration_days) }}" min="1"
                                   class="w-full px-4 py-3 bg-gray-800 border border-white/10 rounded-xl text-white focus:outline-none focus:border-pink-500 transition" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1.5">Kuota</label>
                            <input type="number" name="kuota" value="{{ old('kuota', $trip->kuota) }}" min="1"
                                   placeholder="Kosongkan = tak terbatas"
                                   class="w-full px-4 py-3 bg-gray-800 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-pink-500 transition">
                        </div>
                    </div>
                </div>

                {{-- Status --}}
                <div class="bg-gray-900 border border-white/5 rounded-2xl p-6">
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Publikasi</h3>
                    <div class="space-y-2">
                        <label class="flex items-center gap-3 p-3 rounded-xl border border-white/10 cursor-pointer has-[:checked]:border-emerald-500/50 has-[:checked]:bg-emerald-500/5 transition">
                            <input type="radio" name="status" value="active" {{ old('status', $trip->status) === 'active' ? 'checked' : '' }} class="accent-emerald-500">
                            <div>
                                <p class="text-sm font-medium text-white">Aktif</p>
                                <p class="text-xs text-gray-500">Tampil di website</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-3 rounded-xl border border-white/10 cursor-pointer has-[:checked]:border-gray-500/50 has-[:checked]:bg-gray-500/5 transition">
                            <input type="radio" name="status" value="inactive" {{ old('status', $trip->status) === 'inactive' ? 'checked' : '' }} class="accent-gray-500">
                            <div>
                                <p class="text-sm font-medium text-white">Nonaktif</p>
                                <p class="text-xs text-gray-500">Disembunyikan</p>
                            </div>
                        </label>
                    </div>
                </div>

                <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-6 py-3.5 bg-pink-600 hover:bg-pink-500 text-white font-semibold rounded-xl transition shadow-lg shadow-pink-600/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.dashboard') }}"
                   class="block w-full text-center px-6 py-3 bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white font-medium rounded-xl transition">
                    Batal
                </a>
            </div>
        </div>
    </form>

    <script>
    function previewImage(input) {
        if (!input.files[0]) return;
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById('imagePreview');
            if (preview.tagName === 'IMG') {
                preview.src = e.target.result;
            } else {
                preview.outerHTML = `<img id="imagePreview" src="${e.target.result}" alt="Preview" class="w-full h-44 object-cover">`;
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
    </script>

</x-admin-layout>
