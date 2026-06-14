<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 style="font-family: Georgia, serif; color: #2C1810; font-size: 1.5rem; letter-spacing: 1px;">
                ✦ Les Posts
            </h2>
            @auth
            <a href="{{ route('posts.create') }}"
               style="background: linear-gradient(135deg, #2C1810, #4A2C17); color: #F5E6D3; padding: 10px 24px; border-radius: 25px; font-weight: bold; font-size: 0.85rem; letter-spacing: 1px; text-decoration: none;">
                + Nouveau Post
            </a>
            @endauth
        </div>
    </x-slot>

    <div style="background: #FAF3E8; min-height: 100vh; padding: 40px 0;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div style="background: #D4EDDA; border: 1px solid #C8956C; color: #2C1810; padding: 12px 20px; border-radius: 8px; margin-bottom: 24px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($posts as $post)
                <a href="{{ route('posts.show', $post->slug) }}" class="block" style="text-decoration: none;">
                    <div style="background: #FFFDF7; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(44,24,16,0.08); border: 1px solid #E8D5C0; transition: transform 0.2s, box-shadow 0.2s;"
                         onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 30px rgba(44,24,16,0.15)'"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(44,24,16,0.08)'">

                        @if($post->image)
                        <img src="{{ Storage::url($post->image) }}"
                             style="width: 100%; height: 200px; object-fit: cover;" alt="{{ $post->title }}">
                        @elseif($post->images->count() > 0)
                        <img src="{{ $post->images->first()->image_path }}"
                             style="width: 100%; height: 200px; object-fit: cover;" alt="{{ $post->title }}">
                        @else
                        <div style="width: 100%; height: 120px; background: linear-gradient(135deg, #2C1810, #C8956C); display: flex; align-items: center; justify-content: center;">
                            <span style="color: #F5E6D3; font-size: 2rem;">✦</span>
                        </div>
                        @endif

                        <div style="padding: 20px;">
                            <h3 style="font-family: Georgia, serif; font-size: 1.2rem; color: #2C1810; margin-bottom: 10px; font-weight: bold;">
                                {{ $post->title }}
                            </h3>
                            <p style="color: #7A5C45; font-size: 0.9rem; line-height: 1.6; margin-bottom: 16px;">
                                {{ Str::limit($post->content, 120) }}
                            </p>
                            <div style="display: flex; align-items: center; justify-content: space-between; border-top: 1px solid #E8D5C0; padding-top: 12px;">
                                <span style="color: #C8956C; font-size: 0.85rem; font-weight: 600;">
                                    Par {{ $post->user->name }}
                                </span>
                                <div style="display: flex; gap: 12px;">
                                    <span style="color: #E07B54; font-size: 0.85rem;">❤️ {{ $post->likes->count() }}</span>
                                    <span style="color: #7A5C45; font-size: 0.85rem;">💬 {{ $post->comments->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 60px 0;">
                    <p style="color: #C8956C; font-size: 1.1rem; font-family: Georgia, serif;">Aucun post pour l'instant.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $posts->links() }}
            </div>

        </div>
    </div>
</x-app-layout>