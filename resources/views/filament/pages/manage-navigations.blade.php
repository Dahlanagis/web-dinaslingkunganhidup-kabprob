<x-filament-panels::page>
@php
    $roots = (isset($this) && method_exists($this, 'getRoots')) 
        ? $this->getRoots() 
        : \App\Models\Navigation::whereNull('parent_id')->with(['children' => fn ($q) => $q->orderBy('order', 'asc')])->orderBy('order', 'asc')->get();

    $icons = [
        'HOME' => '<svg style="width:19px;height:19px;" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>',
        'PROFIL' => '<svg style="width:19px;height:19px;" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.333M4.5 21V10.333M2.25 21h19.5"/></svg>',
        'LAYANAN' => '<svg style="width:19px;height:19px;" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"/></svg>',
        'DOKUMEN' => '<svg style="width:19px;height:19px;" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>',
        'INFORMASI' => '<svg style="width:19px;height:19px;" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/></svg>',
    ];
@endphp

<div style="font-family: inherit; margin-top: -10px;">
    <!-- HEADER SECTION (Matching DLH Green Theme) -->
    <div style="display: flex; align-items: center; justify-content: space-between; gap: 24px; margin-bottom: 24px;">
        <div style="flex: 1; min-width: 0;">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                <span style="font-size: 0.72rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.08em; color: #15803d; background: linear-gradient(135deg, #ecfdf5 0%, #f0fdf4 100%); border: 1.5px solid #a7f3d0; padding: 3px 12px; border-radius: 9999px; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 1px 3px rgba(22, 163, 74, 0.08);">
                    <span style="width: 6px; height: 6px; border-radius: 50%; background-color: #16a34a; display: inline-block; box-shadow: 0 0 0 2px #bbf7d0;"></span>
                    ARSITEKTUR NAVIGASI & MENU UTAMA
                </span>
            </div>
            <h2 style="font-size: 1.65rem; font-weight: 900; color: #0f172a; margin: 0 0 6px 0; letter-spacing: -0.025em; line-height: 1.25;">
                Struktur Navigasi & Direktori Publik Portal
            </h2>
            <p style="font-size: 0.9rem; color: #64748b; margin: 0; font-weight: 500; line-height: 1.55;">
                Pusat kendali hierarki menu utama, dropdown interaktif, serta tata kelola alur jelajah informasi publik Dinas Lingkungan Hidup Kab. Probolinggo.
            </p>
        </div>

        <!-- DLH Green + Tambah Menu Baru Button (Locked to Right) -->
        <div style="flex-shrink: 0;">
            <a href="/admin/navigations/create" 
               style="display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); color: #ffffff; font-weight: 800; font-size: 0.88rem; padding: 11px 24px; border-radius: 9999px; text-decoration: none; box-shadow: 0 4px 14px rgba(22, 163, 74, 0.35); border: 1px solid rgba(255, 255, 255, 0.25); white-space: nowrap; transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);"
               onmouseover="this.style.background='linear-gradient(135deg, #15803d 0%, #166534 100%)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(22, 163, 74, 0.45)';"
               onmouseout="this.style.background='linear-gradient(135deg, #16a34a 0%, #15803d 100%)'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 14px rgba(22, 163, 74, 0.35)';"
            >
                <svg style="width: 17px; height: 17px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                <span>Tambah Menu Baru</span>
            </a>
        </div>
    </div>

    <!-- MAIN CONTAINER CARD -->
    <div style="background: #ffffff; border-radius: 22px; border: 1.5px solid #e2e8f0; padding: 24px; box-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.04);">
        @forelse($roots as $root)
            @php
                $orderPadded = sprintf('%02d', $root->order);
                $hasChildren = $root->children->count() > 0;
                $rootIcon = $icons[strtoupper($root->title)] ?? '<svg style="width:19px;height:19px;" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/></svg>';
                $targetBadge = $hasChildren ? 'Dropdown Menu' : $root->url;
            @endphp

            <div style="margin-bottom: 20px;">
                <!-- PARENT MENU CARD (DLH Deep Forest Green Gradient) -->
                <div style="background: linear-gradient(135deg, #092612 0%, #14532d 100%); border-radius: 18px; padding: 16px 22px; color: #ffffff; display: flex; align-items: center; justify-content: space-between; gap: 16px; box-shadow: 0 8px 24px -4px rgba(9, 38, 18, 0.35); border: 1px solid rgba(134, 239, 172, 0.25); position: relative; overflow: hidden; transition: all 0.2s ease;"
                     onmouseover="this.style.boxShadow='0 10px 28px -2px rgba(9, 38, 18, 0.45)'; this.style.borderColor='rgba(134, 239, 172, 0.4)';"
                     onmouseout="this.style.boxShadow='0 8px 24px -4px rgba(9, 38, 18, 0.35)'; this.style.borderColor='rgba(134, 239, 172, 0.25)';"
                >
                    <!-- Subtle top emerald accent line -->
                    <div style="position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, #4ade80 0%, #22c55e 50%, #86efac 100%);"></div>

                    <!-- Left: Order Badge + Menu Label & URL -->
                    <div style="display: flex; align-items: center; gap: 16px; min-width: 0; position: relative; z-index: 2;">
                        <!-- DLH Emerald & Gold Order Badge -->
                        <div style="background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); color: #ffffff; font-weight: 900; font-size: 1.15rem; min-width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(22, 163, 74, 0.4); border: 1.5px solid #86efac; flex-shrink: 0; letter-spacing: -0.02em;">
                            {{ $orderPadded }}
                        </div>

                        <!-- Menu Info -->
                        <div style="display: flex; flex-direction: column; gap: 5px; overflow: hidden;">
                            <div style="display: flex; align-items: center; gap: 10px; font-weight: 800; font-size: 1.15rem; color: #ffffff; line-height: 1.2;">
                                <span style="color: #4ade80; display: flex; align-items: center;">
                                    {!! $rootIcon !!}
                                </span>
                                <span style="letter-spacing: 0.03em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $root->title }}
                                </span>
                            </div>

                            <!-- Badges Row -->
                            <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                <!-- Target / Dropdown Badge -->
                                <div style="display: inline-flex; align-items: center; gap: 5px; background: rgba(255, 255, 255, 0.12); border: 1px solid rgba(255, 255, 255, 0.18); border-radius: 9999px; padding: 2px 10px; font-size: 0.72rem; color: #dcfce7; font-weight: 600;">
                                    <svg style="width: 11px; height: 11px; color: #86efac;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                                    </svg>
                                    <span style="font-family: monospace;">{{ $targetBadge }}</span>
                                </div>

                                <!-- Submenu count indicator -->
                                @if($hasChildren)
                                    <span style="display: inline-flex; align-items: center; gap: 4px; background: rgba(74, 222, 128, 0.15); color: #86efac; border: 1px solid rgba(74, 222, 128, 0.3); font-size: 0.7rem; font-weight: 700; padding: 2px 8px; border-radius: 9999px;">
                                        <span style="width: 5px; height: 5px; border-radius: 50%; background: #4ade80;"></span>
                                        {{ $root->children->count() }} Sub-Menu
                                    </span>
                                @else
                                    <span style="display: inline-flex; align-items: center; gap: 4px; background: rgba(255, 255, 255, 0.08); color: #cbd5e1; border: 1px solid rgba(255, 255, 255, 0.12); font-size: 0.7rem; font-weight: 600; padding: 2px 8px; border-radius: 9999px;">
                                        Tautan Tunggal
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Right Action Buttons -->
                    <div style="display: flex; align-items: center; gap: 8px; flex-shrink: 0; position: relative; z-index: 2;">
                        <!-- Add Submenu (+) Button -->
                        <a href="/admin/navigations/create?parent_id={{ $root->id }}" 
                           title="Tambah Sub-Menu di bawah {{ $root->title }}"
                           style="width: 38px; height: 38px; border-radius: 10px; background: rgba(255, 255, 255, 0.1); border: 1.5px solid rgba(74, 222, 128, 0.4); color: #4ade80; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.2s ease;"
                           onmouseover="this.style.background='rgba(74, 222, 128, 0.25)'; this.style.borderColor='#4ade80'; this.style.transform='scale(1.05)';"
                           onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'; this.style.borderColor='rgba(74, 222, 128, 0.4)'; this.style.transform='scale(1)';"
                        >
                            <svg style="width: 17px; height: 17px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </a>

                        <!-- Edit Button -->
                        <a href="/admin/navigations/{{ $root->id }}/edit" 
                           title="Edit Menu {{ $root->title }}"
                           style="width: 38px; height: 38px; border-radius: 10px; background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); color: #ffffff; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.2s ease;"
                           onmouseover="this.style.background='rgba(255, 255, 255, 0.22)'; this.style.transform='scale(1.05)';"
                           onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'; this.style.transform='scale(1)';"
                        >
                            <svg style="width: 17px; height: 17px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                            </svg>
                        </a>

                        <!-- Delete Button -->
                        <form action="/admin/navigations/{{ $root->id }}/delete" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu \'{{ addslashes($root->title) }}\' {{ $hasChildren ? 'beserta seluruh sub-menunya' : '' }}?');" style="margin: 0;">
                            @csrf
                            <button type="submit" 
                                    title="Hapus Menu {{ $root->title }}"
                                    style="width: 38px; height: 38px; border-radius: 10px; background: rgba(239, 68, 68, 0.16); border: 1px solid rgba(239, 68, 68, 0.3); color: #fca5a5; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s ease;"
                                    onmouseover="this.style.background='#ef4444'; this.style.color='#ffffff'; this.style.borderColor='#ef4444'; this.style.transform='scale(1.05)';"
                                    onmouseout="this.style.background='rgba(239, 68, 68, 0.16)'; this.style.color='#fca5a5'; this.style.borderColor='rgba(239, 68, 68, 0.3)'; this.style.transform='scale(1)';"
                            >
                                <svg style="width: 17px; height: 17px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- SUB-MENU LIST (High-Precision Tree Guide Line) -->
                @if($hasChildren)
                    <div style="margin-left: 28px; position: relative; padding-left: 28px; margin-top: 12px; margin-bottom: 16px;">
                        <!-- Solid High-Precision Emerald Track Rail -->
                        <div style="position: absolute; left: 12px; top: -6px; bottom: 28px; width: 2.5px; background: linear-gradient(180deg, #86efac 0%, #cbd5e1 80%, rgba(203, 213, 225, 0.2) 100%); border-radius: 2px;"></div>

                        @foreach($root->children as $child)
                            <div style="position: relative; margin-bottom: 10px;">
                                <!-- Horizontal Branch with Dot Connector -->
                                <div style="position: absolute; left: -16px; top: 50%; width: 16px; height: 2px; background: #cbd5e1;"></div>
                                <div style="position: absolute; left: -18px; top: calc(50% - 3px); width: 8px; height: 8px; border-radius: 50%; background: #16a34a; border: 2px solid #ffffff; box-shadow: 0 1px 3px rgba(0,0,0,0.15);"></div>

                                <!-- SUBMENU WHITE CARD (DLH Emerald Accent) -->
                                <div style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 14px; padding: 12px 18px; display: flex; align-items: center; justify-content: space-between; gap: 14px; box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04); transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);"
                                     onmouseover="this.style.borderColor='#86efac'; this.style.boxShadow='0 6px 16px rgba(22, 163, 74, 0.12)'; this.style.transform='translateX(4px)';"
                                     onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='0 2px 8px rgba(15, 23, 42, 0.04)'; this.style.transform='translateX(0)';"
                                >
                                    <!-- Left: Submenu Return Arrow & Info -->
                                    <div style="display: flex; align-items: center; gap: 14px; min-width: 0;">
                                        <!-- Return Arrow Icon Box (DLH Green) -->
                                        <div style="width: 36px; height: 36px; border-radius: 10px; background: #f0fdf4; border: 1.5px solid #bbf7d0; color: #16a34a; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 2px 5px rgba(22, 163, 74, 0.08);">
                                            <!-- Standard L-Turn Return Arrow -->
                                            <svg style="width: 17px; height: 17px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 4.5v7.5a3 3 0 003 3h12m0 0l-4.5-4.5m4.5 4.5l-4.5 4.5"/>
                                            </svg>
                                        </div>

                                        <div style="display: flex; flex-direction: column; overflow: hidden;">
                                            <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 1.25;">
                                                {{ $child->title }}
                                            </span>
                                            <span style="font-size: 0.76rem; color: #64748b; font-family: monospace; display: inline-flex; align-items: center; gap: 5px; margin-top: 2px;">
                                                <svg style="width: 11px; height: 11px; color: #16a34a;" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                                                </svg>
                                                {{ $child->url }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Right: Edit & Delete Pill Actions -->
                                    <div style="display: flex; align-items: center; gap: 8px; flex-shrink: 0;">
                                        <!-- Submenu Edit Button (Emerald Accent) -->
                                        <a href="/admin/navigations/{{ $child->id }}/edit" 
                                           title="Edit Sub-Menu"
                                           style="width: 34px; height: 34px; border-radius: 8px; border: 1.5px solid #cbd5e1; background: #ffffff; color: #15803d; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.15s ease;"
                                           onmouseover="this.style.borderColor='#16a34a'; this.style.background='#f0fdf4'; this.style.color='#16a34a'; this.style.transform='scale(1.05)';"
                                           onmouseout="this.style.borderColor='#cbd5e1'; this.style.background='#ffffff'; this.style.color='#15803d'; this.style.transform='scale(1)';"
                                        >
                                            <svg style="width: 15px; height: 15px;" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                            </svg>
                                        </a>

                                        <!-- Submenu Delete Pill Button -->
                                        <form action="/admin/navigations/{{ $child->id }}/delete" method="POST" onsubmit="return confirm('Hapus sub-menu \'{{ addslashes($child->title) }}\'?');" style="margin: 0;">
                                            @csrf
                                            <button type="submit" 
                                                    style="display: inline-flex; align-items: center; gap: 5px; padding: 6px 14px; border-radius: 9999px; border: 1.5px solid #fecaca; background: #fff5f5; color: #dc2626; font-size: 0.78rem; font-weight: 700; cursor: pointer; transition: all 0.15s ease;"
                                                    onmouseover="this.style.background='#fee2e2'; this.style.borderColor='#fca5a5'; this.style.transform='scale(1.03)';"
                                                    onmouseout="this.style.background='#fff5f5'; this.style.borderColor='#fecaca'; this.style.transform='scale(1)';"
                                            >
                                                <svg style="width: 12px; height: 12px;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @empty
            <div style="text-align: center; padding: 48px 20px;">
                <div style="font-size: 3rem; margin-bottom: 12px;">🧭</div>
                <h3 style="font-size: 1.15rem; font-weight: 800; color: #0f172a; margin-bottom: 6px;">
                    Belum Ada Menu Navigasi
                </h3>
                <p style="font-size: 0.85rem; color: #64748b; margin-bottom: 20px;">
                    Struktur menu navigasi header masih kosong. Silakan tambahkan menu utama pertama Anda.
                </p>
                <a href="/admin/navigations/create" 
                   style="display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); color: #ffffff; font-weight: 800; font-size: 0.88rem; padding: 10px 22px; border-radius: 9999px; text-decoration: none;">
                    + Tambah Menu Baru
                </a>
            </div>
        @endforelse
    </div>
</div>
</x-filament-panels::page>
