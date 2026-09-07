<x-filament-widgets::widget>
    <div style="height: 100%; background: white; border-radius: 0.75rem; padding: 1.25rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06); border: 1px solid #f1f5f9;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 0.75rem;">
            <h2 style="font-size: 1.125rem; font-weight: 700; display: flex; align-items: center; gap: 0.5rem; color: #1e293b; margin: 0;">
                <svg style="width: 20px; height: 20px; color: #22c55e; fill: none; stroke: currentColor; stroke-width: 2;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                Dokumen Kinerja Terkini
            </h2>
            <a href="#" style="font-size: 0.875rem; color: #16a34a; text-decoration: none;">Kelola Dokumen &rarr;</a>
        </div>
        
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            @forelse($documents as $doc)
            <div style="display: flex; align-items: center; justify-content: space-between; {{ !$loop->last ? 'border-bottom: 1px solid #f1f5f9; padding-bottom: 0.75rem;' : '' }}">
                <div>
                    <h3 style="font-weight: 700; color: #1e293b; margin: 0;">{{ $doc->title }}</h3>
                    <p style="font-size: 0.75rem; color: #22c55e; margin: 0.25rem 0 0 0;">{{ $doc->category }}</p>
                </div>
                <button style="padding: 0.5rem; background-color: #f0fdf4; border-radius: 0.5rem; color: #16a34a; border: none; cursor: pointer;">
                    <svg style="width: 16px; height: 16px; fill: none; stroke: currentColor; stroke-width: 2;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                </button>
            </div>
            @empty
            <div style="text-align: center; color: #94a3b8; padding: 1rem 0; font-size: 0.875rem;">
                Belum ada dokumen.
            </div>
            @endforelse
        </div>
    </div>
</x-filament-widgets::widget>
