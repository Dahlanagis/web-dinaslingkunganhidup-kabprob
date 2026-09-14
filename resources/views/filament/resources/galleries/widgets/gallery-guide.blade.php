<x-filament-widgets::widget>
    <x-filament::card class="overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
            <div class="space-y-4">
                <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                    Panduan & Fitur Galeri
                </h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Gunakan halaman ini untuk mengelola semua dokumentasi foto dan video kegiatan instansi.
                </p>
                <ul class="space-y-2 text-sm text-gray-700 dark:text-gray-300">
                    <li class="flex items-start gap-2">
                        <x-heroicon-o-check-circle class="w-5 h-5 text-success-500 shrink-0" />
                        <span>Unggah banyak foto sekaligus dalam satu album.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <x-heroicon-o-check-circle class="w-5 h-5 text-success-500 shrink-0" />
                        <span>Tambahkan tautan video YouTube untuk dokumentasi bergerak.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <x-heroicon-o-check-circle class="w-5 h-5 text-success-500 shrink-0" />
                        <span>Kelola album berdasarkan kategori kegiatan (Rapat, Lapangan, dll).</span>
                    </li>
                </ul>
            </div>
            
            <div class="rounded-xl overflow-hidden shadow-sm border border-gray-200 dark:border-gray-700 aspect-video relative bg-gray-100 flex items-center justify-center">
                <!-- Placeholder untuk Video -->
                <div class="absolute inset-0 bg-gradient-to-br from-primary-500/20 to-success-500/20 flex flex-col items-center justify-center text-primary-700 dark:text-primary-400">
                    <x-heroicon-o-play-circle class="w-16 h-16 mb-2 opacity-80" />
                    <span class="font-medium text-sm">Video Panduan (Segera Hadir)</span>
                </div>
            </div>
        </div>
    </x-filament::card>
</x-filament-widgets::widget>
