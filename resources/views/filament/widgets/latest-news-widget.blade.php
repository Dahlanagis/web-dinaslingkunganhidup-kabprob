<x-filament-widgets::widget>
    <div style="height: 100%; background: white; border-radius: 0.75rem; padding: 1.25rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06); border: 1px solid #f1f5f9;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 0.75rem;">
            <h2 style="font-size: 1.125rem; font-weight: 700; display: flex; align-items: center; gap: 0.5rem; color: #1e293b; margin: 0;">
                <svg style="width: 20px; height: 20px; color: #ef4444; fill: none; stroke: currentColor; stroke-width: 2;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-5.25 3h9m-9 3h9m-9-9h.008v.008H6.75V7.5zm0 3h.008v.008H6.75V10.5zm0 3h.008v.008H6.75V13.5zM12.75 3v18H20.25c.828 0 1.5-.672 1.5-1.5V4.5c0-.828-.672-1.5-1.5-1.5h-7.5zm-6 0v18H3.75C2.922 21 2.25 20.328 2.25 19.5V4.5C2.25 3.672 2.922 3 3.75 3h3z" />
                </svg>
                Berita Terkini
            </h2>
            <a href="#" style="font-size: 0.875rem; color: #2563eb; text-decoration: none;">Kelola Berita &rarr;</a>
        </div>
        
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            @forelse($posts as $post)
            <div style="display: flex; gap: 1rem; align-items: center;">
                <div style="width: 64px; height: 64px; background-color: #e2e8f0; border-radius: 0.5rem; overflow: hidden; flex-shrink: 0;">
                    <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://images.unsplash.com/photo-1548848221-0c2e497ed557?w=100&h=100&fit=crop' }}" style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $post->title }}">
                </div>
                <div>
                    <h3 style="font-weight: 700; color: #1e293b; font-size: 0.875rem; margin: 0; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden;">{{ $post->title }}</h3>
                    <p style="font-size: 0.75rem; color: #94a3b8; margin: 0.25rem 0 0 0;">{{ $post->created_at->format('d M Y') }} &bull; {{ $post->views }} views</p>
                </div>
            </div>
            @empty
            <div style="text-align: center; color: #94a3b8; padding: 1rem 0; font-size: 0.875rem;">
                Belum ada berita.
            </div>
            @endforelse
        </div>
    </div>
</x-filament-widgets::widget>
