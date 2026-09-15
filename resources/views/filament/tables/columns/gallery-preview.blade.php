@php
    $record = $getRecord();
    $images = $record->images ?? [];
    if (!is_array($images)) {
        $images = !empty($images) ? [$images] : [];
    }
    // Filter out any empty items
    $images = array_values(array_filter($images, fn($img) => !empty($img)));
    $count = count($images);
    $isVideo = ($record->type === 'video') && !empty($record->video_url);

    $thumbUrl = 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=300&h=300&fit=crop';
    $allUrls = [];

    foreach ($images as $img) {
        $allUrls[] = str_starts_with($img, 'http') ? $img : asset('storage/' . ltrim($img, '/'));
    }

    if ($count > 0) {
        $thumbUrl = $allUrls[0];
    } elseif ($isVideo) {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $record->video_url, $match);
        if (isset($match[1])) {
            $thumbUrl = 'https://img.youtube.com/vi/' . $match[1] . '/hqdefault.jpg';
        }
    }
@endphp

<div x-data="{
        showModal: false,
        activeIndex: 0,
        photos: {{ json_encode($allUrls) }},
        title: {{ json_encode($record->title ?? 'Galeri Foto') }},
        isVideo: {{ $isVideo ? 'true' : 'false' }},
        videoUrl: {{ json_encode($record->video_url ?? '') }},
        next() {
            if (this.photos.length > 0) {
                this.activeIndex = (this.activeIndex + 1) % this.photos.length;
            }
        },
        prev() {
            if (this.photos.length > 0) {
                this.activeIndex = (this.activeIndex - 1 + this.photos.length) % this.photos.length;
            }
        }
    }"
    class="py-2 inline-flex items-center"
>
    <!-- PREVIEW CONTAINER -->
    <div 
        @click.stop="if (photos.length > 0) { activeIndex = 0; showModal = true; }"
        class="relative group cursor-pointer select-none"
        title="{{ $count > 1 ? 'Klik untuk melihat ' . $count . ' foto dalam album ini' : 'Klik untuk memperbesar foto' }}"
        style="width: 76px; height: 76px; margin: 4px 6px;"
    >
        @if($isVideo)
            <!-- VIDEO PREVIEW -->
            <div class="w-full h-full rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm relative bg-slate-900">
                <img src="{{ $thumbUrl }}" alt="{{ $record->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                    <div class="w-8 h-8 rounded-full bg-red-600 text-white flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                        <svg class="w-4 h-4 fill-current ml-0.5" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                </div>
                <div class="absolute bottom-1 right-1 bg-red-600/90 text-white text-[9px] font-bold px-1.5 py-0.5 rounded shadow-xs">
                    VIDEO
                </div>
            </div>

        @elseif($count > 1)
            <!-- ALBUM STACKED EFFECT -->
            <!-- Layer 3 (Back-most card) -->
            <div class="absolute inset-0 rounded-xl bg-slate-200 dark:bg-slate-700 border border-slate-300 dark:border-slate-600 shadow-xs transition-transform duration-300 group-hover:rotate-6 group-hover:scale-95"
                 style="transform: rotate(4deg) scale(0.92); transform-origin: center bottom; top: -3px; right: -4px;">
            </div>

            <!-- Layer 2 (Middle card) -->
            <div class="absolute inset-0 rounded-xl bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-600 shadow-xs transition-transform duration-300 group-hover:-rotate-6 group-hover:scale-95"
                 style="transform: rotate(-3deg) scale(0.96); transform-origin: center bottom; top: -1.5px; left: -3px;">
            </div>

            <!-- Layer 1 (Front Cover) -->
            <div class="relative w-full h-full rounded-xl overflow-hidden border-2 border-white dark:border-slate-800 shadow-md bg-slate-100 dark:bg-slate-900 z-10 transition-all duration-300 group-hover:shadow-lg group-hover:-translate-y-1">
                <img src="{{ $thumbUrl }}" alt="{{ $record->title }}" class="w-full h-full object-cover">

                <!-- Subtle Top Gradient -->
                <div class="absolute inset-x-0 top-0 h-6 bg-gradient-to-b from-black/40 to-transparent pointer-events-none"></div>

                <!-- Album Icon Indicator (Top Right) -->
                <div class="absolute top-1 right-1 bg-emerald-600/90 text-white p-1 rounded-md shadow-xs leading-none">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </div>

                <!-- Bottom Badge: Total Photos in Album -->
                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent px-1 pb-1 pt-3 flex items-center justify-center">
                    <span class="inline-flex items-center gap-1 text-white font-extrabold text-[10px] tracking-wide px-1.5 py-0.5 rounded-full bg-emerald-700/90 backdrop-blur-xs shadow-xs">
                        <svg class="w-2.5 h-2.5 fill-current" viewBox="0 0 20 20"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/></svg>
                        {{ $count }} Foto
                    </span>
                </div>
            </div>

        @else
            <!-- SINGLE PHOTO -->
            <div class="w-full h-full rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-xs relative bg-slate-100 dark:bg-slate-900 group-hover:shadow-md transition-all duration-300 group-hover:-translate-y-0.5">
                <img src="{{ $thumbUrl }}" alt="{{ $record->title }}" class="w-full h-full object-cover">
                <div class="absolute bottom-1 right-1 bg-slate-900/75 backdrop-blur-xs text-white text-[9px] font-semibold px-1.5 py-0.5 rounded-full shadow-xs">
                    1 Foto
                </div>
            </div>
        @endif
    </div>

    <!-- LIGHTBOX MODAL FOR ADMIN TABLE (ALPINE TELEPORT TO BODY) -->
    <template x-teleport="body">
        <div 
            x-show="showModal" 
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @keydown.escape.window="showModal = false"
            @keydown.arrow-right.window="if (showModal) next()"
            @keydown.arrow-left.window="if (showModal) prev()"
            class="fixed inset-0 z-[99999] flex items-center justify-center p-4 bg-black/85 backdrop-blur-md"
            style="display: none;"
        >
            <!-- BACKDROP CLICK TO CLOSE -->
            <div class="absolute inset-0" @click="showModal = false"></div>

            <!-- MODAL CARD -->
            <div 
                @click.stop 
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                class="relative max-w-4xl w-full bg-slate-900 border border-slate-700 rounded-2xl shadow-2xl overflow-hidden flex flex-col max-h-[92vh] z-10 text-white"
            >
                <!-- MODAL HEADER -->
                <div class="flex items-center justify-between px-5 py-3.5 border-b border-slate-800 bg-slate-900/90">
                    <div class="flex items-center gap-2.5 overflow-hidden">
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold tracking-wide uppercase bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                            <span x-text="photos.length > 1 ? 'Album Foto (' + (activeIndex + 1) + ' / ' + photos.length + ')' : 'Foto Tunggal'"></span>
                        </span>
                        <h3 class="font-bold text-sm md:text-base text-slate-100 truncate" x-text="title"></h3>
                    </div>

                    <div class="flex items-center gap-2">
                        <!-- OPEN FULL RESOLUTION IN NEW TAB -->
                        <a 
                            :href="photos[activeIndex]" 
                            target="_blank" 
                            class="p-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white transition-colors"
                            title="Buka Resolusi Penuh"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                        </a>

                        <!-- CLOSE BUTTON -->
                        <button 
                            type="button" 
                            @click="showModal = false" 
                            class="p-2 rounded-lg bg-slate-800 hover:bg-red-600 text-slate-300 hover:text-white transition-colors"
                            title="Tutup (Esc)"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>

                <!-- MAIN IMAGE DISPLAY -->
                <div class="relative flex-1 bg-black/60 flex items-center justify-center p-3 min-h-[360px] max-h-[64vh] overflow-hidden select-none">
                    <img 
                        :src="photos[activeIndex]" 
                        :alt="title" 
                        class="max-h-[60vh] max-w-full w-auto object-contain rounded-lg shadow-2xl transition-opacity duration-200"
                    >

                    <!-- PREV BUTTON -->
                    <button 
                        type="button" 
                        x-show="photos.length > 1"
                        @click.stop="prev()" 
                        class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/60 hover:bg-emerald-600 text-white flex items-center justify-center shadow-lg transition-all duration-200 hover:scale-110"
                        title="Foto Sebelumnya (Panah Kiri)"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
                    </button>

                    <!-- NEXT BUTTON -->
                    <button 
                        type="button" 
                        x-show="photos.length > 1"
                        @click.stop="next()" 
                        class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/60 hover:bg-emerald-600 text-white flex items-center justify-center shadow-lg transition-all duration-200 hover:scale-110"
                        title="Foto Selanjutnya (Panah Kanan)"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                    </button>
                </div>

                <!-- THUMBNAILS STRIP (When > 1 Photo) -->
                <div x-show="photos.length > 1" class="p-3 bg-slate-950 border-t border-slate-800 flex items-center justify-center gap-2 overflow-x-auto">
                    <template x-for="(pic, idx) in photos" :key="idx">
                        <button 
                            type="button" 
                            @click.stop="activeIndex = idx"
                            class="relative w-14 h-14 rounded-lg overflow-hidden border-2 transition-all duration-200 flex-shrink-0"
                            :class="activeIndex === idx ? 'border-emerald-400 scale-105 shadow-md shadow-emerald-500/20 opacity-100 ring-2 ring-emerald-500/50' : 'border-slate-700 opacity-60 hover:opacity-90'"
                        >
                            <img :src="pic" class="w-full h-full object-cover">
                            <span 
                                x-show="activeIndex === idx" 
                                class="absolute top-0.5 right-0.5 w-2 h-2 rounded-full bg-emerald-400"
                            ></span>
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </template>
</div>
