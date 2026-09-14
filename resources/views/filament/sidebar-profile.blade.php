<div style="display: flex; align-items: center; gap: 12px; height: 64px; padding: 0 16px; border-bottom: 1px solid rgba(255, 255, 255, 0.08); box-sizing: border-box; width: 100%;">
    <div style="width: 42px; height: 42px; background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); color: #ffffff; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.15rem; flex-shrink: 0; box-shadow: 0 4px 12px rgba(22, 163, 74, 0.35); border: 1px solid rgba(255,255,255,0.2);">
        {{ strtoupper(substr(auth()->user()?->name ?? 'AD', 0, 2)) }}
    </div>
    <div style="display: flex; flex-direction: column; overflow: hidden; flex: 1; min-width: 0;">
        <span style="color: #ffffff; font-weight: 700; font-size: 0.92rem; line-height: 1.25; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
            {{ auth()->user()?->name ?? 'Admin DLH' }}
        </span>
        @php
            $rRole = auth()->user()?->role ?? 'super_admin';
            $rLabel = match($rRole) {
                'super_admin' => 'SUPER ADMIN',
                'admin' => 'ADMIN PENGELOLA',
                'operator' => 'OPERATOR',
                default => strtoupper($rRole),
            };
            $rColor = match($rRole) {
                'super_admin' => '#4ade80',
                'admin' => '#38bdf8',
                'operator' => '#fbbf24',
                default => '#a3e635',
            };
        @endphp
        <span style="color: {{ $rColor }}; font-size: 0.7rem; font-weight: 800; letter-spacing: 0.05em; margin-top: 2px; white-space: nowrap;">
            ROLE: {{ $rLabel }}
        </span>
    </div>
</div>


