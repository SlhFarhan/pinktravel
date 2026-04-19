<x-admin-layout title="Tambah Trip Baru" active="trips">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition">Dashboard</a>
        <span>/</span>
        <span class="text-gray-300">Tambah Trip</span>
    </nav>

    <form method="POST" action="{{ route('admin.trips.store') }}" enctype="multipart/form-data" id="tripForm">
        @csrf

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- ── Kolom Kiri: Info Utama ──────────────────────────────── --}}
            <div class="xl:col-span-2 space-y-5">

                {{-- Card: Info Dasar --}}
                <div class="bg-gray-900 border border-white/5 rounded-2xl p-6">
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-5">Informasi Trip</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1.5">Judul Trip <span class="text-pink-500">*</span></label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                   placeholder="e.g. Open Trip Banda Neira dari Jakarta"
                                   class="w-full px-4 py-3 bg-gray-800 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500 transition" required>
                            @error('title')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1.5">Kota Keberangkatan <span class="text-pink-500">*</span></label>
                                <input type="text" name="departure_city" value="{{ old('departure_city') }}"
                                       placeholder="e.g. Jakarta"
                                       class="w-full px-4 py-3 bg-gray-800 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500 transition" required>
                                @error('departure_city')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1.5">Destinasi <span class="text-pink-500">*</span></label>
                                <input type="text" name="destination" value="{{ old('destination') }}"
                                       placeholder="e.g. Banda Neira"
                                       class="w-full px-4 py-3 bg-gray-800 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500 transition" required>
                                @error('destination')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1.5">Deskripsi Singkat <span class="text-pink-500">*</span></label>
                            <textarea name="description" rows="3"
                                      placeholder="Deskripsi singkat yang menarik tentang trip ini..."
                                      class="w-full px-4 py-3 bg-gray-800 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500 transition resize-none" required>{{ old('description') }}</textarea>
                            @error('description')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1.5">Overview Lengkap <span class="text-pink-500">*</span></label>
                            <textarea name="overview" rows="4"
                                      placeholder="Penjelasan lengkap tentang perjalanan, highlight, dan pengalaman yang akan didapat..."
                                      class="w-full px-4 py-3 bg-gray-800 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500 transition resize-none" required>{{ old('overview') }}</textarea>
                            @error('overview')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- Card: Titik Kumpul --}}
                <div class="bg-gray-900 border border-white/5 rounded-2xl p-6">
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-5">Titik Kumpul</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1.5">Nama Titik Kumpul <span class="text-pink-500">*</span></label>
                            <input type="text" name="meeting_point" value="{{ old('meeting_point') }}"
                                   placeholder="e.g. Terminal 2 Bandara Soekarno-Hatta"
                                   class="w-full px-4 py-3 bg-gray-800 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500 transition" required>
                            @error('meeting_point')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1.5">Alamat Lengkap <span class="text-pink-500">*</span></label>
                            <input type="text" name="meeting_address" value="{{ old('meeting_address') }}"
                                   placeholder="e.g. Jl. Raya Soetta, Tangerang"
                                   class="w-full px-4 py-3 bg-gray-800 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500 transition" required>
                            @error('meeting_address')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- Card: Itinerary --}}
                <div class="bg-gray-900 border border-white/5 rounded-2xl p-6">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Itinerary Perjalanan</h3>
                        <button type="button" onclick="addItinerary()"
                                class="flex items-center gap-1.5 px-3 py-1.5 bg-pink-600/20 hover:bg-pink-600/30 text-pink-400 text-xs font-semibold rounded-lg transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Hari
                        </button>
                    </div>
                    <div id="itineraries" class="space-y-3">
                        <div class="itinerary-item bg-gray-800 border border-white/5 rounded-xl p-4">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-10 h-10 bg-pink-600/20 rounded-lg flex items-center justify-center">
                                    <span class="text-pink-400 font-bold text-sm day-label">1</span>
                                </div>
                                <div class="flex-1 grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500 mb-1">Judul Hari</label>
                                        <input type="text" name="itineraries[0][title]" placeholder="e.g. Keberangkatan & Tiba"
                                               class="w-full px-3 py-2 bg-gray-700 border border-white/10 rounded-lg text-white placeholder-gray-600 text-sm focus:outline-none focus:border-pink-500 transition">
                                        <input type="hidden" name="itineraries[0][day_number]" value="1">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500 mb-1">Deskripsi</label>
                                        <input type="text" name="itineraries[0][description]" placeholder="Aktivitas hari ini..."
                                               class="w-full px-3 py-2 bg-gray-700 border border-white/10 rounded-lg text-white placeholder-gray-600 text-sm focus:outline-none focus:border-pink-500 transition">
                                    </div>
                                </div>
                                <button type="button" onclick="removeItem(this, '.itinerary-item')" class="text-gray-600 hover:text-red-400 mt-2 transition flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card: Include & Exclude --}}
                <div class="grid grid-cols-2 gap-5">
                    {{-- Included --}}
                    <div class="bg-gray-900 border border-white/5 rounded-2xl p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-semibold text-emerald-400 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Sudah Termasuk
                            </h3>
                            <button type="button" onclick="addInclude()" class="text-emerald-400 hover:text-emerald-300 text-xs font-semibold transition">+ Tambah</button>
                        </div>
                        <div id="includes" class="space-y-2">
                            <div class="include-item flex items-center gap-2">
                                <input type="text" name="includes[0][item_name]" placeholder="e.g. Tiket Pesawat"
                                       class="flex-1 px-3 py-2 bg-gray-800 border border-white/10 rounded-lg text-white placeholder-gray-600 text-sm focus:outline-none focus:border-emerald-500 transition">
                                <input type="hidden" name="includes[0][category]" value="general">
                                <button type="button" onclick="removeItem(this, '.include-item')" class="text-gray-600 hover:text-red-400 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Excluded --}}
                    <div class="bg-gray-900 border border-white/5 rounded-2xl p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-semibold text-red-400 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Tidak Termasuk
                            </h3>
                            <button type="button" onclick="addExclude()" class="text-red-400 hover:text-red-300 text-xs font-semibold transition">+ Tambah</button>
                        </div>
                        <div id="excludes" class="space-y-2">
                            <div class="exclude-item flex items-center gap-2">
                                <input type="text" name="excludes[0][item_name]" placeholder="e.g. Tips Guide"
                                       class="flex-1 px-3 py-2 bg-gray-800 border border-white/10 rounded-lg text-white placeholder-gray-600 text-sm focus:outline-none focus:border-red-500 transition">
                                <input type="hidden" name="excludes[0][category]" value="general">
                                <button type="button" onclick="removeItem(this, '.exclude-item')" class="text-gray-600 hover:text-red-400 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Kolom Kanan: Settings ───────────────────────────────── --}}
            <div class="space-y-5">

                {{-- Card: Upload Gambar --}}
                <div class="bg-gray-900 border border-white/5 rounded-2xl p-6">
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Foto Trip</h3>
                    <div id="imageDropArea"
                         class="border-2 border-dashed border-white/10 rounded-xl p-6 text-center cursor-pointer hover:border-pink-500/50 transition-colors"
                         onclick="document.getElementById('imageInput').click()">
                        <div id="imagePreviewWrap" class="hidden mb-3">
                            <img id="imagePreview" src="" alt="Preview" class="w-full h-40 object-cover rounded-lg">
                        </div>
                        <div id="imagePlaceholder">
                            <div class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <p class="text-sm text-gray-400 font-medium">Klik untuk upload foto</p>
                            <p class="text-xs text-gray-600 mt-1">JPG, PNG, WebP · Maks 5MB</p>
                        </div>
                    </div>
                    <input type="file" id="imageInput" name="image" accept="image/*" class="hidden" onchange="previewImage(this)">
                    @error('image')<p class="text-red-400 text-xs mt-2">{{ $message }}</p>@enderror
                </div>

                {{-- Card: Harga & Durasi --}}
                <div class="bg-gray-900 border border-white/5 rounded-2xl p-6">
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Harga & Kapasitas</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1.5">Harga per Orang (Rp) <span class="text-pink-500">*</span></label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-medium">Rp</span>
                                <input type="number" name="price" value="{{ old('price') }}" min="0"
                                       placeholder="0"
                                       class="w-full pl-10 pr-4 py-3 bg-gray-800 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500 transition" required>
                            </div>
                            @error('price')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1.5">Durasi (Hari) <span class="text-pink-500">*</span></label>
                            <input type="number" name="duration_days" value="{{ old('duration_days') }}" min="1"
                                   placeholder="3"
                                   class="w-full px-4 py-3 bg-gray-800 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500 transition" required>
                            @error('duration_days')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1.5">Kuota Peserta</label>
                            <input type="number" name="kuota" value="{{ old('kuota') }}" min="1"
                                   placeholder="Kosongkan untuk tak terbatas"
                                   class="w-full px-4 py-3 bg-gray-800 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-pink-500 focus:ring-1 focus:ring-pink-500 transition">
                            @error('kuota')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- Card: Status --}}
                <div class="bg-gray-900 border border-white/5 rounded-2xl p-6">
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Publikasi</h3>
                    <div class="space-y-2">
                        <label class="flex items-center gap-3 p-3 rounded-xl border border-white/10 cursor-pointer has-[:checked]:border-emerald-500/50 has-[:checked]:bg-emerald-500/5 transition">
                            <input type="radio" name="status" value="active" {{ old('status', 'active') === 'active' ? 'checked' : '' }} class="accent-emerald-500">
                            <div>
                                <p class="text-sm font-medium text-white">Aktif</p>
                                <p class="text-xs text-gray-500">Tampil di website</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-3 rounded-xl border border-white/10 cursor-pointer has-[:checked]:border-gray-500/50 has-[:checked]:bg-gray-500/5 transition">
                            <input type="radio" name="status" value="inactive" {{ old('status') === 'inactive' ? 'checked' : '' }} class="accent-gray-500">
                            <div>
                                <p class="text-sm font-medium text-white">Nonaktif</p>
                                <p class="text-xs text-gray-500">Disembunyikan dari publik</p>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-6 py-3.5 bg-pink-600 hover:bg-pink-500 text-white font-semibold rounded-xl transition shadow-lg shadow-pink-600/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Trip
                </button>
                <a href="{{ route('admin.dashboard') }}"
                   class="block w-full text-center px-6 py-3 bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white font-medium rounded-xl transition">
                    Batal
                </a>

            </div>
        </div>
    </form>

    <script>
    let itineraryCount = 1, includeCount = 1, excludeCount = 1;

    function previewImage(input) {
        if (!input.files[0]) return;
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('imagePreview').src = e.target.result;
            document.getElementById('imagePreviewWrap').classList.remove('hidden');
            document.getElementById('imagePlaceholder').classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }

    function addItinerary() {
        const container = document.getElementById('itineraries');
        const idx = itineraryCount;
        container.insertAdjacentHTML('beforeend', `
            <div class="itinerary-item bg-gray-800 border border-white/5 rounded-xl p-4">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-pink-600/20 rounded-lg flex items-center justify-center">
                        <span class="text-pink-400 font-bold text-sm">${idx + 1}</span>
                    </div>
                    <div class="flex-1 grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Judul Hari</label>
                            <input type="text" name="itineraries[${idx}][title]" placeholder="e.g. Snorkeling & Pantai"
                                   class="w-full px-3 py-2 bg-gray-700 border border-white/10 rounded-lg text-white placeholder-gray-600 text-sm focus:outline-none focus:border-pink-500 transition">
                            <input type="hidden" name="itineraries[${idx}][day_number]" value="${idx + 1}">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Deskripsi</label>
                            <input type="text" name="itineraries[${idx}][description]" placeholder="Aktivitas hari ini..."
                                   class="w-full px-3 py-2 bg-gray-700 border border-white/10 rounded-lg text-white placeholder-gray-600 text-sm focus:outline-none focus:border-pink-500 transition">
                        </div>
                    </div>
                    <button type="button" onclick="removeItem(this, '.itinerary-item')" class="text-gray-600 hover:text-red-400 mt-2 transition flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>`);
        itineraryCount++;
    }

    function addInclude() {
        const container = document.getElementById('includes');
        container.insertAdjacentHTML('beforeend', `
            <div class="include-item flex items-center gap-2">
                <input type="text" name="includes[${includeCount}][item_name]" placeholder="e.g. Akomodasi"
                       class="flex-1 px-3 py-2 bg-gray-800 border border-white/10 rounded-lg text-white placeholder-gray-600 text-sm focus:outline-none focus:border-emerald-500 transition">
                <input type="hidden" name="includes[${includeCount}][category]" value="general">
                <button type="button" onclick="removeItem(this, '.include-item')" class="text-gray-600 hover:text-red-400 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>`);
        includeCount++;
    }

    function addExclude() {
        const container = document.getElementById('excludes');
        container.insertAdjacentHTML('beforeend', `
            <div class="exclude-item flex items-center gap-2">
                <input type="text" name="excludes[${excludeCount}][item_name]" placeholder="e.g. Tips Guide"
                       class="flex-1 px-3 py-2 bg-gray-800 border border-white/10 rounded-lg text-white placeholder-gray-600 text-sm focus:outline-none focus:border-red-500 transition">
                <input type="hidden" name="excludes[${excludeCount}][category]" value="general">
                <button type="button" onclick="removeItem(this, '.exclude-item')" class="text-gray-600 hover:text-red-400 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>`);
        excludeCount++;
    }

    function removeItem(btn, selector) {
        const item = btn.closest(selector);
        if (item) item.remove();
    }
    </script>

</x-admin-layout>
