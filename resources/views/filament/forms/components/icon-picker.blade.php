<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        x-data="{
            state: $wire.$entangle(@js($getStatePath())),
            open: false,
            search: '',
            customVal: '',

            icons: [
                // Persis seperti contoh gambar user (Baris 1-3)
                { cls: 'bi-activity', tags: 'pulse denyut kesehatan grafik medis' },
                { cls: 'bi-alarm', tags: 'alarm jam waktu pengingat clock' },
                { cls: 'bi-archive', tags: 'arsip berkas kotak archive' },
                { cls: 'bi-award', tags: 'penghargaan medali sertifikat adipura piala' },
                { cls: 'bi-bag', tags: 'tas belanja kantong ramah lingkungan' },
                { cls: 'bi-bank', tags: 'kantor dinas gedung bank instansi pemerintah' },
                { cls: 'bi-bell', tags: 'notifikasi lonceng info pemberitahuan' },
                { cls: 'bi-book', tags: 'buku pedoman panduan aturan bacaan' },
                { cls: 'bi-bookmark', tags: 'penanda simpan favorit mark' },
                { cls: 'bi-box', tags: 'kotak kardus wadah kemasan' },
                { cls: 'bi-briefcase', tags: 'tas kerja dinas profesi berkas kerja' },
                { cls: 'bi-building', tags: 'gedung dinas dlh kantor pemerintah' },
                { cls: 'bi-calculator', tags: 'hitung kalkulator retribusi anggaran' },
                { cls: 'bi-calendar', tags: 'kalender agenda jadwal tanggal' },
                { cls: 'bi-camera', tags: 'kamera foto dokumentasi gambar' },
                { cls: 'bi-cloud-upload', tags: 'upload unggah berkas dokumen' },
                { cls: 'bi-list-check', tags: 'daftar checklist verifikasi tugas' },
                { cls: 'bi-card-text', tags: 'kartu berita teks informasi' },

                // Dokumen, Izin Lingkungan & Berkas
                { cls: 'bi-file-text', tags: 'dokumen surat berkas teks perizinan' },
                { cls: 'bi-file-earmark-check', tags: 'izin amdal ukl upl dokumen sah' },
                { cls: 'bi-file-earmark-check-fill', tags: 'persetujuan lingkungan terbit' },
                { cls: 'bi-file-earmark-text', tags: 'maklumat pelayanan berkas' },
                { cls: 'bi-file-earmark-text-fill', tags: 'surat keputusan edaran dinas' },
                { cls: 'bi-journal-check', tags: 'regulasi perda perbup sk dinas' },
                { cls: 'bi-file-earmark-ruled', tags: 'sop standar prosedur aturan' },
                { cls: 'bi-card-checklist', tags: 'tupoksi tugas pokok fungsi' },
                { cls: 'bi-shield-check', tags: 'penegakan hukum perda legal' },
                { cls: 'bi-shield-lock', tags: 'keamanan portal perlindungan' },

                // Persampahan & Kebersihan Lingkungan
                { cls: 'bi-trash', tags: 'sampah tempat buang kotor waste' },
                { cls: 'bi-trash-fill', tags: 'sampah solid penuh' },
                { cls: 'bi-trash3', tags: 'wadah sampah tps' },
                { cls: 'bi-trash3-fill', tags: 'tempat sampah dlh tps3r' },
                { cls: 'bi-recycle', tags: 'daur ulang daur pilah recycle 3r' },
                { cls: 'bi-truck', tags: 'truk armada sampah mobil angkutan' },
                { cls: 'bi-truck-flatbed', tags: 'mobil operasional dinas' },
                { cls: 'bi-box-seam', tags: 'bank sampah kardus pilah' },
                { cls: 'bi-box-seam-fill', tags: 'kemasan sampah boks' },
                { cls: 'bi-basket', tags: 'keranjang sampah wadah' },
                { cls: 'bi-bucket', tags: 'ember limbah cair penampungan' },
                { cls: 'bi-water', tags: 'saluran air limbah kali sungai' },

                // Lingkungan, Pohon, RTH & Alam
                { cls: 'bi-tree', tags: 'pohon penghijauan rth taman hutan' },
                { cls: 'bi-tree-fill', tags: 'pohon rindang rth kota' },
                { cls: 'bi-flower1', tags: 'bunga taman hias keanekaragaman' },
                { cls: 'bi-flower2', tags: 'tanaman hias flora taman' },
                { cls: 'bi-flower3', tags: 'tumbuhan kehati rth' },
                { cls: 'bi-droplet', tags: 'air droplet tetesan air bersih' },
                { cls: 'bi-droplet-half', tags: 'uji lab air hidrologi' },
                { cls: 'bi-droplet-fill', tags: 'sumber air sungai mata air' },
                { cls: 'bi-wind', tags: 'angin udara ispu emisi polusi' },
                { cls: 'bi-cloud-sun', tags: 'cuaca cerah kualitas udara' },
                { cls: 'bi-cloud-sun-fill', tags: 'iklim udara cerah' },
                { cls: 'bi-cloud-haze2', tags: 'asap polusi kabut emisi' },
                { cls: 'bi-sun', tags: 'matahari surya terang panas' },
                { cls: 'bi-sun-fill', tags: 'sinar matahari energi surya' },
                { cls: 'bi-globe-americas', tags: 'bumi kelestarian dunia global' },
                { cls: 'bi-globe', tags: 'lingkungan hidup global dunia' },
                { cls: 'bi-lightning-charge', tags: 'energi terbarukan listrik kencang' },
                { cls: 'bi-lightning-charge-fill', tags: 'daya energi hemat' },

                // Layanan, Pengaduan, Aspirasi & Kontak
                { cls: 'bi-megaphone', tags: 'aduan lapor aspirasi masyarakat' },
                { cls: 'bi-megaphone-fill', tags: 'sp4n lapor pengaduan cepat' },
                { cls: 'bi-headset', tags: 'call center halo sae bantuan cs' },
                { cls: 'bi-chat-dots', tags: 'saran tanya konsultasi diskusi' },
                { cls: 'bi-chat-dots-fill', tags: 'pesan interaktif saran' },
                { cls: 'bi-whatsapp', tags: 'wa whatsapp chat pengaduan' },
                { cls: 'bi-telephone', tags: 'telepon kontak nomor hotline' },
                { cls: 'bi-telephone-fill', tags: 'panggilan telepon dinas' },
                { cls: 'bi-envelope', tags: 'email surel surat pesan' },
                { cls: 'bi-envelope-fill', tags: 'kirim email resmi' },
                { cls: 'bi-send-fill', tags: 'kirim surat pesan aspirasi' },
                { cls: 'bi-info-circle', tags: 'informasi bantuan petunjuk info' },
                { cls: 'bi-info-circle-fill', tags: 'info penting dinas' },

                // Kantor, Profil, Pejabat & Struktur
                { cls: 'bi-building-fill', tags: 'gedung dlh kabupaten kantor' },
                { cls: 'bi-diagram-3', tags: 'struktur organisasi bagan hirarki' },
                { cls: 'bi-diagram-3-fill', tags: 'susunan kepemimpinan bagan' },
                { cls: 'bi-person-badge', tags: 'pejabat pimpinan id card pegawai' },
                { cls: 'bi-person-badge-fill', tags: 'asn kartu tanda dinas' },
                { cls: 'bi-people', tags: 'masyarakat warga pegawai komunitas' },
                { cls: 'bi-people-fill', tags: 'tim kemitraan gotong royong' },
                { cls: 'bi-person', tags: 'profil perorangan pegawai' },
                { cls: 'bi-compass', tags: 'visi misi arah tujuan kompas' },
                { cls: 'bi-compass-fill', tags: 'arah kebijakan strategi dlh' },
                { cls: 'bi-clock-history', tags: 'sejarah riwayat instansi waktu' },
                { cls: 'bi-geo-alt', tags: 'peta lokasi koordinat alamat map' },
                { cls: 'bi-geo-alt-fill', tags: 'titik pantau rth tps lokasi' },

                // Publikasi, Berita, Foto & Data
                { cls: 'bi-newspaper', tags: 'berita koran artikel warta siaran' },
                { cls: 'bi-journal-richtext', tags: 'artikel opini edukasi tulisan' },
                { cls: 'bi-images', tags: 'galeri foto dokumentasi album' },
                { cls: 'bi-image', tags: 'foto gambar ilustrasi' },
                { cls: 'bi-camera-video', tags: 'video rekaman liputan film' },
                { cls: 'bi-camera-video-fill', tags: 'dokumentasi video lapangan' },
                { cls: 'bi-calendar-event', tags: 'agenda aksi bersih event kegiatan' },
                { cls: 'bi-calendar-event-fill', tags: 'jadwal resmi tanggal' },
                { cls: 'bi-graph-up-arrow', tags: 'grafik naik tren kinerja capaian' },
                { cls: 'bi-bar-chart-line', tags: 'diagram statistik batang data' },
                { cls: 'bi-bar-chart-fill', tags: 'statistik volume sampah indikator' },
                { cls: 'bi-pie-chart', tags: 'diagram lingkaran proporsi persen' },
                { cls: 'bi-pie-chart-fill', tags: 'neraca pengelolaan sampah rasio' },
                { cls: 'bi-speedometer2', tags: 'baku mutu kecepatan meteran indeks' },
                { cls: 'bi-house-door', tags: 'beranda home halaman utama portal' },
                { cls: 'bi-house-door-fill', tags: 'halaman awal website' },
                { cls: 'bi-gear', tags: 'pengaturan setting sistem kelola' },
                { cls: 'bi-check-circle-fill', tags: 'sukses berhasil terverifikasi' }
            ],

            select(c) {
                this.state = c;
                this.open = false;
            },

            clear() {
                this.state = '';
            },

            applyCustom() {
                let v = this.customVal.trim();
                if (v) {
                    if (!v.startsWith('bi-') && !v.startsWith('bi ')) v = 'bi-' + v;
                    this.select(v);
                    this.customVal = '';
                }
            },

            get filtered() {
                let q = this.search.toLowerCase().trim();
                let list = [...this.icons];
                if (this.state) {
                    let cur = this.currentIcon;
                    let exists = list.some(item => item.cls === cur || item.cls === this.state);
                    if (!exists) {
                        list.unshift({ cls: cur, tags: 'ikon terpilih tersimpan' });
                    }
                }

                if (!q) return list;
                return list.filter(item => item.cls.toLowerCase().includes(q) || (item.tags && item.tags.toLowerCase().includes(q)));
            },

            get currentIcon() {
                if (!this.state) return '';
                let s = this.state.trim();
                if (s.startsWith('bi-') || s.startsWith('bi ')) return s;
                if (s.startsWith('heroicon-o-')) return 'bi-' + s.replace('heroicon-o-', '');
                return 'bi-' + s;
            }
        }"
        class="dlh-ip-wrapper"
        @click.outside="open = false"
        @keydown.escape.window="open = false"
    >
        <style>
            .dlh-ip-wrapper {
                position: relative;
                width: 100%;
                font-family: inherit;
            }

            /* TAMPILAN AWAL INPUT PERSIS SEPERTI GAMBAR USER */
            .dlh-ip-input-box {
                display: flex;
                align-items: stretch;
                background: #ffffff;
                border: 1px solid #d1d5db;
                border-radius: 8px;
                overflow: hidden;
                transition: border-color 0.15s ease, box-shadow 0.15s ease;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            }
            .dlh-ip-input-box.is-focused,
            .dlh-ip-input-box:focus-within {
                border-color: #3b82f6;
                box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.18);
            }
            .dlh-ip-input-field {
                flex: 1;
                min-width: 0;
                border: none;
                outline: none;
                background: transparent;
                padding: 8px 14px;
                font-size: 0.9375rem;
                color: #0f172a;
                font-family: inherit;
            }
            .dlh-ip-input-field::placeholder {
                color: #94a3b8;
            }
            .dlh-ip-pilih-btn {
                border: none;
                border-left: 1px solid #e2e8f0;
                background: #ffffff;
                color: #475569;
                padding: 0 18px;
                font-size: 0.9375rem;
                font-weight: 500;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: background 0.15s ease, color 0.15s ease;
                user-select: none;
            }
            .dlh-ip-pilih-btn:hover {
                background: #f8fafc;
                color: #0f172a;
            }

            /* DROPDOWN POPUP KETIKA DIKLIK PILIH */
            .dlh-ip-dropdown {
                position: absolute;
                top: calc(100% + 6px);
                left: 0;
                right: 0;
                background: #ffffff;
                border: 1px solid #cbd5e1;
                border-radius: 14px;
                box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12), 0 4px 10px rgba(0, 0, 0, 0.05);
                z-index: 100;
                overflow: hidden;
            }
            .dlh-ip-header {
                padding: 10px 14px;
                background: #f8fafc;
                border-bottom: 1px solid #edf2f7;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 10px;
                flex-wrap: wrap;
            }
            .dlh-ip-search-wrap {
                position: relative;
                flex: 1;
                min-width: 200px;
            }
            .dlh-ip-search-input {
                width: 100%;
                padding: 7px 30px 7px 32px;
                font-size: 0.8125rem;
                color: #1e293b;
                background: #ffffff;
                border: 1px solid #cbd5e1;
                border-radius: 8px;
                outline: none;
                box-sizing: border-box;
                transition: border-color 0.2s, box-shadow 0.2s;
            }
            .dlh-ip-search-input:focus {
                border-color: #3b82f6;
                box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.15);
            }
            .dlh-ip-search-icon {
                position: absolute;
                left: 10px;
                top: 50%;
                transform: translateY(-50%);
                color: #94a3b8;
                font-size: 0.8125rem;
                pointer-events: none;
            }
            .dlh-ip-search-clear {
                position: absolute;
                right: 8px;
                top: 50%;
                transform: translateY(-50%);
                border: none;
                background: none;
                color: #94a3b8;
                cursor: pointer;
                font-size: 0.8125rem;
                padding: 0;
            }
            .dlh-ip-selected-pill {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 4px 10px;
                background: #eff6ff;
                border: 1px solid #bfdbfe;
                border-radius: 8px;
                font-size: 0.8125rem;
                color: #1d4ed8;
                font-weight: 700;
            }
            .dlh-ip-clear-btn {
                border: none;
                background: none;
                color: #94a3b8;
                cursor: pointer;
                padding: 0;
                display: flex;
                align-items: center;
                font-size: 0.75rem;
            }
            .dlh-ip-clear-btn:hover {
                color: #ef4444;
            }
            .dlh-ip-close-btn {
                border: none;
                background: none;
                color: #64748b;
                cursor: pointer;
                padding: 4px 8px;
                border-radius: 6px;
                font-size: 0.875rem;
                display: flex;
                align-items: center;
                transition: background 0.15s, color 0.15s;
            }
            .dlh-ip-close-btn:hover {
                background: #fee2e2;
                color: #ef4444;
            }

            /* GRID IKON 6 KOLOM KOTAK MEMIKAT */
            .dlh-ip-grid-area {
                padding: 14px;
                max-height: 250px;
                overflow-y: auto;
                background: #ffffff;
                box-sizing: border-box;
            }
            .dlh-ip-grid {
                display: grid;
                grid-template-columns: repeat(6, 1fr);
                gap: 10px;
            }
            .dlh-ip-square {
                aspect-ratio: 1 / 1;
                min-height: 48px;
                border-radius: 12px;
                background: #ffffff;
                border: 1px solid #e2e8f0;
                color: #334155;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.45rem;
                cursor: pointer;
                transition: transform 0.15s ease, background 0.15s ease, border-color 0.15s ease, color 0.15s ease;
                padding: 0;
                box-sizing: border-box;
                outline: none;
            }
            .dlh-ip-square:hover {
                transform: scale(1.06);
                background: #f8fafc;
                border-color: #93c5fd;
                color: #2563eb;
                box-shadow: 0 4px 10px rgba(37, 99, 235, 0.08);
            }
            /* GAYA AKTIF BIRU LEMBUT SESUAI PREFERENSI USER */
            .dlh-ip-square.is-active {
                background: #dbeafe !important;
                border: 2px solid #3b82f6 !important;
                color: #1d4ed8 !important;
                box-shadow: 0 4px 12px rgba(59, 130, 246, 0.22) !important;
                transform: scale(1.03);
            }
            .dlh-ip-footer {
                padding: 8px 14px;
                background: #f8fafc;
                border-top: 1px solid #edf2f7;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 8px;
                font-size: 0.75rem;
            }
            .dlh-ip-custom-input {
                flex: 1;
                padding: 5px 10px;
                font-family: monospace;
                font-size: 0.75rem;
                border: 1px solid #cbd5e1;
                border-radius: 6px;
                outline: none;
                background: #ffffff;
            }
            .dlh-ip-custom-input:focus {
                border-color: #3b82f6;
            }
            .dlh-ip-custom-btn {
                padding: 5px 12px;
                background: #eff6ff;
                border: 1px solid #bfdbfe;
                color: #1d4ed8;
                border-radius: 6px;
                font-weight: 700;
                cursor: pointer;
                font-size: 0.75rem;
            }
            .dlh-ip-custom-btn:hover {
                background: #dbeafe;
            }
            .dlh-ip-done-btn {
                padding: 5px 14px;
                background: #0284c7;
                border: none;
                color: #ffffff;
                border-radius: 6px;
                font-weight: 600;
                cursor: pointer;
                font-size: 0.75rem;
                transition: background 0.15s;
            }
            .dlh-ip-done-btn:hover {
                background: #0369a1;
            }

            @media (max-width: 640px) {
                .dlh-ip-grid {
                    grid-template-columns: repeat(4, 1fr);
                }
            }
        </style>

        <!-- INPUT DENGAN TOMBOL 'PILIH' (PERSIS SEPERTI GAMBAR USER) -->
        <div class="dlh-ip-input-box" :class="open ? 'is-focused' : ''">
            <input
                type="text"
                x-model="state"
                placeholder="bi-file-text"
                class="dlh-ip-input-field"
                @focus="open = true"
            />
            <button
                type="button"
                @click="open = !open"
                class="dlh-ip-pilih-btn"
            >
                Pilih
            </button>
        </div>

        <!-- POPUP MODAL/DROPDOWN KOTAK IKON MUNCUL KETIKA KLIK PILIH -->
        <div
            x-show="open"
            x-cloak
            class="dlh-ip-dropdown"
            style="display: none;"
        >
            <!-- Header: Filter & Preview -->
            <div class="dlh-ip-header">
                <div class="dlh-ip-search-wrap">
                    <i class="bi bi-search dlh-ip-search-icon"></i>
                    <input
                        type="text"
                        x-model="search"
                        placeholder="Ketik untuk memfilter ikon (misal: sampah, pohon, air, berkas)..."
                        class="dlh-ip-search-input"
                    />
                    <template x-if="search">
                        <button type="button" @click="search = ''" class="dlh-ip-search-clear">
                            <i class="bi bi-x-circle-fill"></i>
                        </button>
                    </template>
                </div>

                <div style="display: flex; align-items: center; gap: 8px;">
                    <template x-if="state">
                        <div class="dlh-ip-selected-pill">
                            <i :class="currentIcon" style="font-size: 1.15rem;"></i>
                            <span x-text="state"></span>
                            <button type="button" @click="clear()" title="Hapus Ikon" class="dlh-ip-clear-btn">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    </template>
                    <button type="button" @click="open = false" class="dlh-ip-close-btn" title="Tutup">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            </div>

            <!-- Grid 6 Kolom Kotak Ikon -->
            <div class="dlh-ip-grid-area">
                <div class="dlh-ip-grid">
                    <template x-for="item in filtered" :key="item.cls">
                        <button
                            type="button"
                            @click="select(item.cls)"
                            :class="state === item.cls ? 'dlh-ip-square is-active' : 'dlh-ip-square'"
                            :title="item.cls"
                        >
                            <i :class="item.cls"></i>
                        </button>
                    </template>
                </div>

                <template x-if="filtered.length === 0">
                    <div style="text-align: center; padding: 24px 0; color: #94a3b8; font-size: 0.8125rem;">
                        Tidak ada ikon yang sesuai dengan kata kunci "<span x-text="search"></span>"
                    </div>
                </template>
            </div>

            <!-- Footer: Manual atau Tutup -->
            <div class="dlh-ip-footer">
                <div style="display: flex; align-items: center; gap: 8px; flex: 1;">
                    <span style="color: #64748b; font-size: 0.72rem; white-space: nowrap;">Atau ketik:</span>
                    <input
                        type="text"
                        x-model="customVal"
                        @keydown.enter.prevent="applyCustom()"
                        placeholder="Contoh: bi-pin-map"
                        class="dlh-ip-custom-input"
                    />
                    <button type="button" @click="applyCustom()" class="dlh-ip-custom-btn">
                        Terapkan
                    </button>
                </div>
                <button type="button" @click="open = false" class="dlh-ip-done-btn">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</x-dynamic-component>
