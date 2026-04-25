<x-admin-layout title="Manajemen Review" active="reviews">
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-white">Manajemen Review</h2>
        <p class="text-gray-500 mt-1">Moderasi ulasan dari para traveler PinkTravel</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <a href="{{ route('admin.reviews.dashboard', ['status' => 'all']) }}" class="block group">
            <div class="bg-gray-900/50 border {{ request('status', 'all') == 'all' ? 'border-pink-500/50 bg-pink-500/5' : 'border-white/5' }} p-6 rounded-2xl transition-all group-hover:border-pink-500/30">
                <p class="text-gray-500 text-sm mb-1">Semua Review</p>
                <h3 class="text-2xl font-bold text-white">{{ $allReviews->count() }}</h3>
            </div>
        </a>
        <a href="{{ route('admin.reviews.dashboard', ['status' => 'pending']) }}" class="block group">
            <div class="bg-gray-900/50 border {{ request('status') == 'pending' ? 'border-yellow-500/50 bg-yellow-500/5' : 'border-white/5' }} p-6 rounded-2xl transition-all group-hover:border-yellow-500/30">
                <p class="text-gray-500 text-sm mb-1">Perlu Moderasi</p>
                <h3 class="text-2xl font-bold text-white text-yellow-500">{{ $pendingReviews->count() }}</h3>
            </div>
        </a>
        <a href="{{ route('admin.reviews.dashboard', ['status' => 'approved']) }}" class="block group">
            <div class="bg-gray-900/50 border {{ request('status') == 'approved' ? 'border-emerald-500/50 bg-emerald-500/5' : 'border-white/5' }} p-6 rounded-2xl transition-all group-hover:border-emerald-500/30">
                <p class="text-gray-500 text-sm mb-1">Disetujui</p>
                <h3 class="text-2xl font-bold text-white text-emerald-500">{{ $approvedReviews->count() }}</h3>
            </div>
        </a>
        <a href="{{ route('admin.reviews.dashboard', ['status' => 'rejected']) }}" class="block group">
            <div class="bg-gray-900/50 border {{ request('status') == 'rejected' ? 'border-red-500/50 bg-red-500/5' : 'border-white/5' }} p-6 rounded-2xl transition-all group-hover:border-red-500/30">
                <p class="text-gray-500 text-sm mb-1">Ditolak</p>
                <h3 class="text-2xl font-bold text-white text-red-500">{{ $rejectedReviews->count() }}</h3>
            </div>
        </a>
    </div>

    <!-- Reviews Table -->
    <div class="bg-gray-900/50 border border-white/5 rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white/5">
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">User</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Trip / Destinasi</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Rating & Komentar</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($reviews as $review)
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-pink-500/10 text-pink-500 flex items-center justify-center font-bold">
                                    {{ substr($review->user->name ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-white">{{ $review->user->name ?? 'Deleted User' }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5">{{ $review->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-6">
                            <p class="text-sm font-medium text-white">{{ $review->reviewable?->title ?? $review->reviewable?->name ?? 'Item Deleted' }}</p>
                            <span class="inline-block px-2 py-0.5 mt-1 bg-white/5 text-[10px] text-gray-400 rounded">
                                {{ $review->reviewable_type ? str_replace('App\\Models\\', '', $review->reviewable_type) : 'N/A' }}
                            </span>
                        </td>
                        <td class="px-6 py-6">
                            <div class="flex items-center gap-1 mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-3.5 h-3.5 {{ $i <= $review->rating ? 'text-yellow-500' : 'text-gray-700' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                    </svg>
                                @endfor
                            </div>
                            <p class="text-sm text-gray-400 line-clamp-2 italic" style="max-width: 300px;">
                                "{{ $review->comment }}"
                            </p>
                        </td>
                        <td class="px-6 py-6 text-sm">
                            @if($review->status == 'pending')
                                <span class="px-3 py-1 bg-yellow-500/10 text-yellow-500 border border-yellow-500/20 rounded-full text-xs">Pending</span>
                            @elseif($review->status == 'approved')
                                <span class="px-3 py-1 bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 rounded-full text-xs">Approved</span>
                            @else
                                <span class="px-3 py-1 bg-red-500/10 text-red-500 border border-red-500/20 rounded-full text-xs">Rejected</span>
                            @endif
                        </td>
                        <td class="px-6 py-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                @if($review->status != 'approved')
                                <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <button type="submit" class="p-2 bg-emerald-500/10 text-emerald-500 hover:bg-emerald-500 hover:text-white rounded-lg transition-all" title="Setujui Review">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    </button>
                                </form>
                                @endif

                                @if($review->status != 'rejected')
                                <form action="{{ route('admin.reviews.reject', $review->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <button type="submit" class="p-2 bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all" title="Tolak Review">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <svg class="w-12 h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                <p class="text-gray-500">Belum ada review untuk kategori ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
