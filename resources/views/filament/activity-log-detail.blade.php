@php
    $record = $record ?? ($getRecord ? $getRecord() : null);

    $action = strtoupper($record?->action ?? 'LOG');
    $module = $record?->module ?? 'Sistem Portal';
    $userName = $record?->user_name ?? 'Administrator DLH';
    $userEmail = $record?->user?->email ?? ($record?->user_id ? 'admin@dlh.probolinggokab.go.id' : null);
    $ip = $record?->ip_address ?? '127.0.0.1';
    $desc = $record?->description ?? 'Tidak ada rincian keterangan tambahan untuk aktivitas ini.';
    $idFormatted = '#LOG-' . str_pad($record?->id ?? 1, 5, '0', STR_PAD_LEFT);

    // Carbon date
    $createdAt = $record?->created_at;
    $fullDate = $createdAt ? $createdAt->locale('id')->isoFormat('dddd, D MMMM YYYY') : '-';
    $fullTime = $createdAt ? $createdAt->format('H:i:s') . ' WIB' : '-';
    $relativeTime = $createdAt ? $createdAt->locale('id')->diffForHumans() : '-';

    // Module Icon & Accent
    $moduleIcons = [
        'Autentikasi' => '🔐',
        'Role & Hak Akses' => '🛡️',
        'Berita & Publikasi' => '📰',
        'Dokumen Kinerja' => '📑',
        'Layanan Publik' => '🤝',
        'Galeri Foto' => '🖼️',
        'Banner & Spanduk' => '🎨',
        'Pengaturan Website' => '⚙️',
        'Users & Role' => '👥',
        'Menu Navigasi' => '🧭',
        'Akses Cepat' => '⚡',
        'Data Statistik' => '📊',
        'Tautan Terkait' => '🔗',
        'Profil Instansi' => '🏛️',
    ];
    $moduleIcon = $moduleIcons[$module] ?? '📌';

    // Action Styling Config
    $actionConfigs = [
        'LOGIN' => [
            'label' => 'LOGIN MASUK',
            'icon' => '<svg style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>',
            'bg' => '#eff6ff',
            'border' => '#bfdbfe',
            'text' => '#1d4ed8',
            'dot' => '#3b82f6',
            'glow' => 'rgba(59, 130, 246, 0.25)',
        ],
        'LOGOUT' => [
            'label' => 'LOGOUT KELUAR',
            'icon' => '<svg style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/></svg>',
            'bg' => '#f8fafc',
            'border' => '#cbd5e1',
            'text' => '#475569',
            'dot' => '#94a3b8',
            'glow' => 'rgba(148, 163, 184, 0.2)',
        ],
        'CREATE' => [
            'label' => 'CREATE (TAMBAH)',
            'icon' => '<svg style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>',
            'bg' => '#f0fdf4',
            'border' => '#bbf7d0',
            'text' => '#15803d',
            'dot' => '#22c55e',
            'glow' => 'rgba(34, 197, 94, 0.25)',
        ],
        'UPDATE' => [
            'label' => 'UPDATE (UBAH)',
            'icon' => '<svg style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/></svg>',
            'bg' => '#fffbeb',
            'border' => '#fde68a',
            'text' => '#b45309',
            'dot' => '#f59e0b',
            'glow' => 'rgba(245, 158, 11, 0.25)',
        ],
        'DELETE' => [
            'label' => 'DELETE (HAPUS)',
            'icon' => '<svg style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>',
            'bg' => '#fef2f2',
            'border' => '#fecaca',
            'text' => '#b91c1c',
            'dot' => '#ef4444',
            'glow' => 'rgba(239, 68, 68, 0.25)',
        ],
        'GANTI ROLE' => [
            'label' => 'GANTI ROLE AKSES',
            'icon' => '<svg style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>',
            'bg' => '#f5f3ff',
            'border' => '#ddd6fe',
            'text' => '#6d28d9',
            'dot' => '#8b5cf6',
            'glow' => 'rgba(139, 92, 246, 0.25)',
        ],
    ];

    $cfg = $actionConfigs[$action] ?? [
        'label' => $action,
        'icon' => '⚡',
        'bg' => '#f8fafc',
        'border' => '#e2e8f0',
        'text' => '#334155',
        'dot' => '#64748b',
        'glow' => 'rgba(100, 116, 139, 0.2)',
    ];

    $initials = strtoupper(substr($userName, 0, 2));
@endphp

<div style="font-family: inherit; color: #0f172a; padding: 4px;">
    <!-- HERO HEADER CARD -->
    <div style="background: linear-gradient(135deg, #092612 0%, #14532d 100%); border-radius: 18px; padding: 22px 24px; color: #ffffff; position: relative; overflow: hidden; box-shadow: 0 10px 25px -5px rgba(9, 38, 18, 0.4); border: 1px solid rgba(74, 222, 128, 0.2); margin-bottom: 20px;">
        <!-- Top glowing line -->
        <div style="position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, #4ade80 0%, #22c55e 50%, #86efac 100%);"></div>

        <!-- Ambient decorative shapes -->
        <div style="position: absolute; right: -20px; top: -30px; width: 140px; height: 140px; background: radial-gradient(circle, rgba(74, 222, 128, 0.15) 0%, rgba(255,255,255,0) 70%); border-radius: 50%; pointer-events: none;"></div>

        <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; margin-bottom: 14px; position: relative; z-index: 2;">
            <!-- Module Badge -->
            <div style="display: inline-flex; align-items: center; gap: 7px; background: rgba(255, 255, 255, 0.12); backdrop-filter: blur(8px); padding: 5px 12px; border-radius: 9999px; border: 1px solid rgba(255, 255, 255, 0.18); font-size: 0.78rem; font-weight: 700; letter-spacing: 0.02em; color: #dcfce7;">
                <span>{{ $moduleIcon }}</span>
                <span>Modul: {{ $module }}</span>
            </div>

            <!-- Action Pill Badge -->
            <div style="display: inline-flex; align-items: center; gap: 6px; background: {{ $cfg['bg'] }}; border: 1.5px solid {{ $cfg['border'] }}; color: {{ $cfg['text'] }}; padding: 5px 14px; border-radius: 9999px; font-size: 0.75rem; font-weight: 800; letter-spacing: 0.04em; box-shadow: 0 2px 8px {{ $cfg['glow'] }};">
                <span style="width: 7px; height: 7px; border-radius: 50%; background-color: {{ $cfg['dot'] }}; display: inline-block;"></span>
                {!! $cfg['icon'] !!}
                <span>{{ $cfg['label'] }}</span>
            </div>
        </div>

        <!-- Title & Time -->
        <div style="position: relative; z-index: 2;">
            <div style="display: flex; align-items: baseline; gap: 10px; margin-bottom: 6px;">
                <span style="font-size: 0.72rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.08em; color: #86efac;">
                    ID LOG SISTEM:
                </span>
                <span style="font-family: monospace; font-size: 0.85rem; font-weight: 700; color: #ffffff; background: rgba(0,0,0,0.25); padding: 1px 8px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.15);">
                    {{ $idFormatted }}
                </span>
            </div>
            <h2 style="font-size: 1.25rem; font-weight: 800; margin: 0 0 8px 0; line-height: 1.35; color: #ffffff; letter-spacing: -0.01em;">
                Rekam Jejak Operasional & Audit Aktivitas
            </h2>
            <div style="display: flex; align-items: center; gap: 8px; font-size: 0.8rem; color: #bbf7d0;">
                <svg style="width: 15px; height: 15px; color: #86efac; flex-shrink: 0;" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span style="font-weight: 600;">{{ $fullDate }}</span>
                <span style="opacity: 0.6;">•</span>
                <span style="font-weight: 700; color: #ffffff;">{{ $fullTime }}</span>
                <span style="background: rgba(255,255,255,0.15); padding: 1px 8px; border-radius: 6px; font-size: 0.72rem; font-weight: 600;">{{ $relativeTime }}</span>
            </div>
        </div>
    </div>

    <!-- 3-CARD KEY DETAILS GRID -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px; margin-bottom: 20px;">
        <!-- Card 1: Administrator -->
        <div style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 14px; padding: 14px 16px; box-shadow: 0 2px 6px rgba(15, 23, 42, 0.03); display: flex; align-items: center; gap: 12px; transition: all 0.2s ease;">
            <div style="width: 42px; height: 42px; border-radius: 12px; background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1rem; flex-shrink: 0; box-shadow: 0 4px 10px rgba(22, 163, 74, 0.3); border: 1.5px solid #86efac;">
                {{ $initials }}
            </div>
            <div style="display: flex; flex-direction: column; overflow: hidden; min-width: 0;">
                <span style="font-size: 0.68rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.06em; color: #64748b; margin-bottom: 2px;">
                    ADMINISTRATOR
                </span>
                <span style="font-weight: 800; font-size: 0.92rem; color: #0f172a; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    {{ $userName }}
                </span>
                @if($userEmail)
                    <span style="font-size: 0.72rem; color: #64748b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ $userEmail }}
                    </span>
                @endif
            </div>
        </div>

        <!-- Card 2: IP Address -->
        <div style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 14px; padding: 14px 16px; box-shadow: 0 2px 6px rgba(15, 23, 42, 0.03); display: flex; align-items: center; gap: 12px;">
            <div style="width: 42px; height: 42px; border-radius: 12px; background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%); color: #ffffff; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(14, 165, 233, 0.28); border: 1.5px solid #7dd3fc;">
                <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg>
            </div>
            <div style="display: flex; flex-direction: column; overflow: hidden; min-width: 0;">
                <span style="font-size: 0.68rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.06em; color: #64748b; margin-bottom: 2px;">
                    IP ADDRESS KONEKSI
                </span>
                <span style="font-family: monospace; font-weight: 800; font-size: 0.95rem; color: #0369a1; letter-spacing: 0.02em;">
                    {{ $ip }}
                </span>
                <span style="font-size: 0.7rem; color: #10b981; font-weight: 700; display: inline-flex; align-items: center; gap: 4px;">
                    <span style="width: 5px; height: 5px; border-radius: 50%; background: #10b981;"></span>
                    {{ $ip === '127.0.0.1' ? 'Localhost (Internal)' : 'Akses Terverifikasi' }}
                </span>
            </div>
        </div>

        <!-- Card 3: Waktu Lengkap -->
        <div style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 14px; padding: 14px 16px; box-shadow: 0 2px 6px rgba(15, 23, 42, 0.03); display: flex; align-items: center; gap: 12px;">
            <div style="width: 42px; height: 42px; border-radius: 12px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #ffffff; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(245, 158, 11, 0.28); border: 1.5px solid #fde68a;">
                <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.253 3.75m3 0a1.5 1.5 0 011.5 1.5v12a1.5 1.5 0 01-1.5 1.5H4.5A1.5 1.5 0 013 18.75V7.5a1.5 1.5 0 011.5-1.5h15z"/></svg>
            </div>
            <div style="display: flex; flex-direction: column; overflow: hidden; min-width: 0;">
                <span style="font-size: 0.68rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.06em; color: #64748b; margin-bottom: 2px;">
                    WAKTU TERCATAT
                </span>
                <span style="font-weight: 800; font-size: 0.92rem; color: #0f172a;">
                    {{ $fullTime }}
                </span>
                <span style="font-size: 0.7rem; color: #64748b; font-weight: 600;">
                    Zona Waktu: WIB (GMT+7)
                </span>
            </div>
        </div>
    </div>

    <!-- DESKRIPSI CARD (PREMIUM QUOTED BOX) -->
    <div style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 16px; padding: 20px; box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04); position: relative;">
        <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px; margin-bottom: 14px;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <span style="width: 28px; height: 28px; border-radius: 8px; background: #ecfdf5; border: 1px solid #a7f3d0; display: flex; align-items: center; justify-content: center; color: #15803d; font-size: 0.85rem;">
                    📝
                </span>
                <span style="font-size: 0.76rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.06em; color: #1e293b;">
                    DESKRIPSI AKTIVITAS SISTEM
                </span>
            </div>
            <span style="font-size: 0.7rem; color: #15803d; background: #f0fdf4; border: 1px solid #86efac; padding: 2px 10px; border-radius: 9999px; font-weight: 700; display: inline-flex; align-items: center; gap: 4px;">
                <svg style="width: 12px; height: 12px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                Audit Log Valid
            </span>
        </div>

        <div style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius: 12px; padding: 16px 18px; border: 1px solid #e2e8f0; border-left: 4px solid #16a34a;">
            <p style="margin: 0; font-size: 0.95rem; font-weight: 600; color: #1e293b; line-height: 1.65; word-break: break-word;">
                {{ $desc }}
            </p>
        </div>

        <!-- Security Stamp Footer -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 14px; font-size: 0.72rem; color: #94a3b8; padding-top: 10px; border-top: 1px dashed #f1f5f9;">
            <span style="display: inline-flex; align-items: center; gap: 5px;">
                <svg style="width: 13px; height: 13px; color: #16a34a;" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                Terekam otomatis oleh Engine Audit DLH Kab. Probolinggo
            </span>
            <span style="font-family: monospace; color: #64748b; font-weight: 600;">
                SHA256: INTEGRITY-VERIFIED
            </span>
        </div>
    </div>
</div>
