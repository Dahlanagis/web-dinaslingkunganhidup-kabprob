@php
    $currentTab = request()->query('tab', 'foto');
@endphp

<style>
    .custom-gallery-tabs {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 0;
        padding: 0;
    }
    
    .custom-tab-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 24px;
        border-radius: 9999px;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid transparent;
    }

    .custom-tab-btn svg {
        width: 20px;
        height: 20px;
    }

    /* Inactive State */
    .custom-tab-inactive {
        background-color: transparent;
        color: #64748b;
        border-color: transparent;
    }
    .custom-tab-inactive:hover {
        background-color: rgba(0, 0, 0, 0.05);
        color: #0f172a;
    }
    .custom-tab-inactive svg {
        color: #94a3b8;
    }
    .custom-tab-inactive:hover svg {
        color: #64748b;
    }

    /* Active State */
    .custom-tab-active {
        background: linear-gradient(135deg, #15803d 0%, #14532d 100%);
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(21, 128, 61, 0.3);
    }
    .custom-tab-active svg {
        color: #ffffff !important;
    }
</style>

<div class="custom-gallery-tabs">
    <a href="?tab=foto" 
       class="custom-tab-btn {{ $currentTab === 'foto' || $currentTab === null ? 'custom-tab-active' : 'custom-tab-inactive' }}">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M1 8a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 018.07 3h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0016.07 6H17a2 2 0 012 2v7a2 2 0 01-2 2H3a2 2 0 01-2-2V8zm13.5 3a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM10 14a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
        </svg>
        Galeri Foto
    </a>

    <a href="?tab=video" 
       class="custom-tab-btn {{ $currentTab === 'video' ? 'custom-tab-active' : 'custom-tab-inactive' }}">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path d="M3.25 4A2.25 2.25 0 001 6.25v7.5A2.25 2.25 0 003.25 16h7.5A2.25 2.25 0 0013 13.75v-7.5A2.25 2.25 0 0010.75 4h-7.5zM19 4.75a.75.75 0 00-1.28-.53l-3 3a.75.75 0 00-.22.53v4.5c0 .199.079.39.22.53l3 3a.75.75 0 001.28-.53V4.75z" />
        </svg>
        Galeri Video
    </a>
</div>
