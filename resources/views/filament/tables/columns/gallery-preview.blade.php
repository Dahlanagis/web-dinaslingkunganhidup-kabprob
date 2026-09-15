@php
    $record = $getRecord();
    $images = $record->images ?? [];
    if (!is_array($images)) {
        $images = !empty($images) ? [$images] : [];
    }
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
    style="display: inline-block; vertical-align: middle; padding: 4px 0;"
>
    <!-- THUMBNAIL CONTAINER -->
    <div 
        @click.stop="if (photos.length > 0) { activeIndex = 0; showModal = true; }"
        title="{{ $count > 1 ? 'Klik untuk melihat ' . $count . ' foto dalam album ini' : 'Klik untuk memperbesar' }}"
        style="position: relative; width: 68px; height: 68px; cursor: pointer; user-select: none; display: inline-block;"
    >
        @if($isVideo)
            <!-- VIDEO PREVIEW -->
            <div style="position: relative; width: 68px; height: 68px; border-radius: 10px; overflow: hidden; border: 1px solid #e2e8f0; background: #0f172a; box-shadow: 0 2px 6px rgba(0,0,0,0.12);">
                <img src="{{ $thumbUrl }}" alt="{{ $record->title }}" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                <!-- Play Icon -->
                <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;">
                    <div style="width: 26px; height: 26px; border-radius: 50%; background: #dc2626; color: #ffffff; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 6px rgba(0,0,0,0.3);">
                        <svg style="width: 12px; height: 12px; fill: currentColor; margin-left: 1px;" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                </div>
            </div>

        @elseif($count > 1)
            <!-- ALBUM STACKED EFFECT -->
            <!-- Layer Belakang (Card 2) -->
            <div style="position: absolute; top: -3px; right: -4px; width: 66px; height: 66px; border-radius: 10px; background: #cbd5e1; border: 1px solid #94a3b8; transform: rotate(4deg); z-index: 1;"></div>
            <!-- Layer Tengah (Card 1) -->
            <div style="position: absolute; top: -1.5px; left: -3px; width: 66px; height: 66px; border-radius: 10px; background: #e2e8f0; border: 1px solid #cbd5e1; transform: rotate(-3deg); z-index: 2;"></div>
            <!-- Foto Depan (Cover) -->
            <div style="position: relative; width: 68px; height: 68px; border-radius: 10px; overflow: hidden; border: 2px solid #ffffff; background: #f8fafc; box-shadow: 0 4px 10px rgba(0,0,0,0.15); z-index: 3;">
                <img src="{{ $thumbUrl }}" alt="{{ $record->title }}" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                
                <!-- Badge Album di Bawah Foto -->
                <div style="position: absolute; bottom: 3px; left: 50%; transform: translateX(-50%); background: rgba(5, 150, 105, 0.92); color: #ffffff; font-size: 9.5px; font-weight: 700; padding: 1.5px 6px; border-radius: 9999px; white-space: nowrap; box-shadow: 0 2px 4px rgba(0,0,0,0.3); display: flex; align-items: center; gap: 3px;">
                    <svg style="width: 9px; height: 9px; fill: currentColor; display: inline-block;" viewBox="0 0 20 20"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/></svg>
                    <span>{{ $count }} Foto</span>
                </div>
            </div>

        @else
            <!-- SINGLE PHOTO -->
            <div style="position: relative; width: 68px; height: 68px; border-radius: 10px; overflow: hidden; border: 1px solid #cbd5e1; background: #f8fafc; box-shadow: 0 2px 6px rgba(0,0,0,0.08);">
                <img src="{{ $thumbUrl }}" alt="{{ $record->title }}" style="width: 100%; height: 100%; object-fit: cover; display: block;">
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
            style="display: none; position: fixed; inset: 0; z-index: 99999; background: rgba(0, 0, 0, 0.85); backdrop-filter: blur(8px); display: flex; align-items: center; justify-content: center; padding: 16px;"
        >
            <!-- BACKDROP CLICK TO CLOSE -->
            <div style="position: absolute; inset: 0;" @click="showModal = false"></div>

            <!-- MODAL CARD -->
            <div 
                @click.stop 
                style="position: relative; max-width: 820px; width: 100%; background: #0f172a; border: 1px solid #334155; border-radius: 16px; box-shadow: 0 25px 60px rgba(0,0,0,0.6); overflow: hidden; display: flex; flex-direction: column; max-height: 90vh; z-index: 10; color: #ffffff;"
            >
                <!-- MODAL HEADER -->
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 12px 18px; border-bottom: 1px solid #1e293b; background: rgba(15, 23, 42, 0.95);">
                    <div style="display: flex; align-items: center; gap: 10px; overflow: hidden;">
                        <span style="padding: 3px 10px; border-radius: 9999px; font-size: 11px; font-weight: 700; text-transform: uppercase; background: rgba(16, 185, 129, 0.2); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3); white-space: nowrap;">
                            <span x-text="photos.length > 1 ? 'Album (' + (activeIndex + 1) + ' / ' + photos.length + ')' : 'Foto Tunggal'"></span>
                        </span>
                        <h4 style="margin: 0; font-size: 14px; font-weight: 700; color: #f8fafc; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" x-text="title"></h4>
                    </div>

                    <div style="display: flex; align-items: center; gap: 8px;">
                        <!-- OPEN FULL RESOLUTION IN NEW TAB -->
                        <a 
                            :href="photos[activeIndex]" 
                            target="_blank" 
                            style="padding: 6px 10px; border-radius: 8px; background: #1e293b; color: #cbd5e1; text-decoration: none; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;"
                            title="Buka Resolusi Penuh"
                        >
                            <span>Buka Ukuran Asli</span>
                            <svg style="width: 12px; height: 12px; display: inline-block;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                        </a>

                        <!-- CLOSE BUTTON -->
                        <button 
                            type="button" 
                            @click="showModal = false" 
                            style="width: 30px; height: 30px; border-radius: 8px; background: #1e293b; color: #cbd5e1; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: bold; transition: background 0.15s;"
                            onmouseover="this.style.background='#dc2626'; this.style.color='#fff';"
                            onmouseout="this.style.background='#1e293b'; this.style.color='#cbd5e1';"
                            title="Tutup (Esc)"
                        >
                            ✕
                        </button>
                    </div>
                </div>

                <!-- MAIN IMAGE DISPLAY -->
                <div style="position: relative; flex: 1; background: rgba(0,0,0,0.6); display: flex; align-items: center; justify-content: center; padding: 12px; min-height: 340px; max-height: 65vh; overflow: hidden; user-select: none;">
                    <img 
                        :src="photos[activeIndex]" 
                        :alt="title" 
                        style="max-height: 60vh; max-width: 100%; width: auto; object-fit: contain; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);"
                    >

                    <!-- PREV BUTTON -->
                    <button 
                        type="button" 
                        x-show="photos.length > 1"
                        @click.stop="prev()" 
                        style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); width: 42px; height: 42px; border-radius: 50%; background: rgba(0,0,0,0.7); color: #ffffff; border: 1px solid rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 18px; font-weight: bold; box-shadow: 0 4px 12px rgba(0,0,0,0.4);"
                        title="Foto Sebelumnya (Panah Kiri)"
                    >
                        ❮
                    </button>

                    <!-- NEXT BUTTON -->
                    <button 
                        type="button" 
                        x-show="photos.length > 1"
                        @click.stop="next()" 
                        style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); width: 42px; height: 42px; border-radius: 50%; background: rgba(0,0,0,0.7); color: #ffffff; border: 1px solid rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 18px; font-weight: bold; box-shadow: 0 4px 12px rgba(0,0,0,0.4);"
                        title="Foto Selanjutnya (Panah Kanan)"
                    >
                        ❯
                    </button>
                </div>

                <!-- THUMBNAILS STRIP (When > 1 Photo) -->
                <div x-show="photos.length > 1" style="padding: 10px; background: #030712; border-top: 1px solid #1e293b; display: flex; align-items: center; justify-content: center; gap: 8px; overflow-x: auto;">
                    <template x-for="(pic, idx) in photos" :key="idx">
                        <button 
                            type="button" 
                            @click.stop="activeIndex = idx"
                            style="position: relative; width: 48px; height: 48px; border-radius: 8px; overflow: hidden; border: 2px solid transparent; flex-shrink: 0; cursor: pointer; padding: 0; background: none;"
                            :style="activeIndex === idx ? 'border-color: #10b981; opacity: 1; transform: scale(1.05);' : 'border-color: #334155; opacity: 0.6;'"
                        >
                            <img :src="pic" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </template>
</div>
