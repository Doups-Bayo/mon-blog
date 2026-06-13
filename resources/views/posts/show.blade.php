<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family: Georgia, serif; color: #2C1810; font-size: 1.5rem; letter-spacing: 1px;">
            ✦ {{ $post->title }}
        </h2>
    </x-slot>

    <div style="background: #FAF3E8; min-height: 100vh; padding: 40px 0;">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div style="background: #D4EDDA; border: 1px solid #C8956C; color: #2C1810; padding: 12px 20px; border-radius: 8px; margin-bottom: 24px;">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Post -->
            <div style="background: #FFFDF7; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(44,24,16,0.08); border: 1px solid #E8D5C0; margin-bottom: 32px;">

                @if($post->image)
                    <img src="{{ Storage::url($post->image) }}"
                         style="width: 100%; height: 350px; object-fit: cover;" alt="{{ $post->title }}">
                @else
                    <div style="width: 100%; height: 150px; background: linear-gradient(135deg, #2C1810, #C8956C); display: flex; align-items: center; justify-content: center;">
                        <span style="color: #F5E6D3; font-size: 3rem;">✦</span>
                    </div>
                @endif

                <!-- Carrousel -->
                @if($post->images->count() > 0)
                <div style="padding: 20px; background: #FAF3E8;">
                    <div id="carousel" style="position: relative; overflow: hidden; border-radius: 12px;">
                        <div id="carousel-inner" style="display: flex; transition: transform 0.5s ease;">
                            @foreach($post->images as $index => $image)
                            <div style="min-width: 100%; position: relative;">
                                <img src="{{ Storage::url($image->image_path) }}"
                                     style="width: 100%; height: 400px; object-fit: cover; border-radius: 12px;"
                                     alt="Image {{ $index + 1 }}">
                                <div style="position: absolute; bottom: 12px; right: 16px; background: rgba(44,24,16,0.6); color: #F5E6D3; padding: 4px 12px; border-radius: 20px; font-size: 0.85rem;">
                                    {{ $index + 1 }} / {{ $post->images->count() }}
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Boutons navigation -->
                        @if($post->images->count() > 1)
                        <button onclick="changeSlide(-1)"
                                style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); background: rgba(44,24,16,0.7); color: #F5E6D3; border: none; width: 40px; height: 40px; border-radius: 50%; font-size: 1.2rem; cursor: pointer;">
                            ‹
                        </button>
                        <button onclick="changeSlide(1)"
                                style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: rgba(44,24,16,0.7); color: #F5E6D3; border: none; width: 40px; height: 40px; border-radius: 50%; font-size: 1.2rem; cursor: pointer;">
                            ›
                        </button>
                        @endif

                        <!-- Points de navigation -->
                        <div style="position: absolute; bottom: 12px; left: 50%; transform: translateX(-50%); display: flex; gap: 8px;">
                            @foreach($post->images as $index => $image)
                            <div class="dot" onclick="goToSlide({{ $index }})"
                                 style="width: 8px; height: 8px; border-radius: 50%; background: {{ $index === 0 ? '#F5E6D3' : 'rgba(245,230,211,0.5)' }}; cursor: pointer; transition: background 0.3s;"></div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <div style="padding: 32px;">
                    <h1 style="font-family: Georgia, serif; font-size: 2rem; color: #2C1810; margin-bottom: 16px; font-weight: bold;">
                        {{ $post->title }}
                    </h1>

                    <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid #E8D5C0;">
                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #2C1810, #C8956C); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #F5E6D3; font-weight: bold;">
                            {{ substr($post->user->name, 0, 1) }}
                        </div>
                        <div>
                            <div style="color: #2C1810; font-weight: bold;">{{ $post->user->name }}</div>
                            <div style="color: #C8956C; font-size: 0.85rem;">{{ $post->published_at->diffForHumans() }}</div>
                        </div>
                    </div>

                    <div style="color: #4A3728; line-height: 1.9; font-size: 1rem; margin-bottom: 32px;">
                        {!! nl2br(e($post->content)) !!}
                    </div>

                    <!-- Actions -->
                    <div style="display: flex; align-items: center; gap: 12px; padding-top: 20px; border-top: 1px solid #E8D5C0; flex-wrap: wrap;">

                        @auth
                        <form action="{{ route('posts.like', $post) }}" method="POST">
                            @csrf
                            <button type="submit" style="background: #FFF0EB; border: 1px solid #E8D5C0; color: #E07B54; padding: 8px 20px; border-radius: 25px; font-weight: bold; cursor: pointer; font-size: 0.9rem;">
                                ❤️ {{ $post->likes->count() }} J'aime
                            </button>
                        </form>
                        @endauth

                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('posts.show', $post->slug)) }}"
                           target="_blank"
                           style="background: #1877F2; color: white; padding: 8px 20px; border-radius: 25px; font-size: 0.85rem; font-weight: bold; text-decoration: none;">
                            Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('posts.show', $post->slug)) }}&text={{ urlencode($post->title) }}"
                           target="_blank"
                           style="background: #1DA1F2; color: white; padding: 8px 20px; border-radius: 25px; font-size: 0.85rem; font-weight: bold; text-decoration: none;">
                            Twitter
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . route('posts.show', $post->slug)) }}"
                           target="_blank"
                           style="background: #25D366; color: white; padding: 8px 20px; border-radius: 25px; font-size: 0.85rem; font-weight: bold; text-decoration: none;">
                            WhatsApp
                        </a>

                        @can('update', $post)
                        <div style="margin-left: auto; display: flex; gap: 8px;">
                            <a href="{{ route('posts.edit', $post) }}"
                               style="background: #F5E6D3; color: #2C1810; padding: 8px 20px; border-radius: 25px; font-size: 0.85rem; font-weight: bold; text-decoration: none; border: 1px solid #C8956C;">
                                ✏️ Modifier
                            </a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                  onsubmit="return confirm('Supprimer ce post ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        style="background: #FFF0EB; color: #C0392B; padding: 8px 20px; border-radius: 25px; font-size: 0.85rem; font-weight: bold; border: 1px solid #E8B4B8; cursor: pointer;">
                                    🗑️ Supprimer
                                </button>
                            </form>
                        </div>
                        @endcan
                    </div>
                </div>
            </div>

            <!-- Commentaires -->
            <div style="background: #FFFDF7; border-radius: 16px; padding: 32px; box-shadow: 0 4px 20px rgba(44,24,16,0.08); border: 1px solid #E8D5C0;">
                <h3 style="font-family: Georgia, serif; font-size: 1.3rem; color: #2C1810; margin-bottom: 24px;">
                    💬 {{ $post->comments->count() }} Commentaire(s)
                </h3>

                @auth
                <form action="{{ route('comments.store', $post) }}" method="POST" style="margin-bottom: 32px;">
                    @csrf
                    <textarea name="content" rows="3"
                              style="width: 100%; border: 1px solid #E8D5C0; border-radius: 12px; padding: 12px 16px; margin-bottom: 12px; font-size: 0.95rem; color: #4A3728; background: #FAF3E8; resize: vertical;"
                              placeholder="Écrire un commentaire..."></textarea>
                    @error('content')
                        <p style="color: #C0392B; font-size: 0.85rem; margin-bottom: 8px;">{{ $message }}</p>
                    @enderror
                    <button type="submit"
                            style="background: linear-gradient(135deg, #2C1810, #4A2C17); color: #F5E6D3; padding: 10px 28px; border-radius: 25px; font-weight: bold; border: none; cursor: pointer;">
                        Commenter
                    </button>
                </form>
                @else
                <p style="color: #7A5C45; margin-bottom: 24px;">
                    <a href="{{ route('login') }}" style="color: #C8956C; font-weight: bold;">Connecte-toi</a> pour commenter.
                </p>
                @endauth

                @forelse($post->comments->whereNull('parent_id') as $comment)
                <div style="border-bottom: 1px solid #E8D5C0; padding-bottom: 20px; margin-bottom: 20px;">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 10px;">
                        <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #C8956C, #E8D5C0); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #2C1810; font-weight: bold; font-size: 0.9rem;">
                            {{ substr($comment->user->name, 0, 1) }}
                        </div>
                        <div style="flex: 1;">
                            <strong style="color: #2C1810;">{{ $comment->user->name }}</strong>
                            <span style="color: #C8956C; font-size: 0.8rem; margin-left: 8px;">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        @auth
                        @if(auth()->id() === $comment->user_id)
                        <div style="display: flex; gap: 8px;">
                            <button onclick="document.getElementById('edit-comment-{{ $comment->id }}').style.display='block'; document.getElementById('text-comment-{{ $comment->id }}').style.display='none'"
                                    style="background: #F5E6D3; color: #2C1810; border: 1px solid #C8956C; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; cursor: pointer;">
                                ✏️ Modifier
                            </button>
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST"
                                  onsubmit="return confirm('Supprimer ce commentaire ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        style="background: #FFF0EB; color: #C0392B; border: 1px solid #E8B4B8; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; cursor: pointer;">
                                    🗑️ Supprimer
                                </button>
                            </form>
                        </div>
                        @endif
                        @endauth
                    </div>

                    <p id="text-comment-{{ $comment->id }}" style="color: #4A3728; line-height: 1.6; margin-left: 48px;">{{ $comment->content }}</p>

                    <div id="edit-comment-{{ $comment->id }}" style="display: none; margin-left: 48px; margin-top: 8px;">
                        <form action="{{ route('comments.update', $comment) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <textarea name="content" rows="2"
                                      style="width: 100%; border: 1px solid #E8D5C0; border-radius: 12px; padding: 10px 14px; font-size: 0.9rem; color: #4A3728; background: #FAF3E8; margin-bottom: 8px;">{{ $comment->content }}</textarea>
                            <div style="display: flex; gap: 8px;">
                                <button type="submit"
                                        style="background: linear-gradient(135deg, #2C1810, #4A2C17); color: #F5E6D3; padding: 6px 20px; border-radius: 20px; font-size: 0.85rem; border: none; cursor: pointer;">
                                    Sauvegarder
                                </button>
                                <button type="button"
                                        onclick="document.getElementById('edit-comment-{{ $comment->id }}').style.display='none'; document.getElementById('text-comment-{{ $comment->id }}').style.display='block'"
                                        style="background: #F5E6D3; color: #2C1810; padding: 6px 20px; border-radius: 20px; font-size: 0.85rem; border: 1px solid #C8956C; cursor: pointer;">
                                    Annuler
                                </button>
                            </div>
                        </form>
                    </div>

                    @foreach($comment->replies as $reply)
                    <div style="margin-left: 48px; margin-top: 12px; padding-left: 16px; border-left: 2px solid #C8956C;">
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                            <div style="width: 28px; height: 28px; background: linear-gradient(135deg, #C8956C, #E8D5C0); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #2C1810; font-weight: bold; font-size: 0.8rem;">
                                {{ substr($reply->user->name, 0, 1) }}
                            </div>
                            <strong style="color: #2C1810; font-size: 0.9rem;">{{ $reply->user->name }}</strong>
                            <span style="color: #C8956C; font-size: 0.8rem;">{{ $reply->created_at->diffForHumans() }}</span>
                        </div>
                        <p style="color: #4A3728; line-height: 1.6; margin-left: 36px; font-size: 0.9rem;">{{ $reply->content }}</p>
                    </div>
                    @endforeach
                </div>
                @empty
                <p style="color: #C8956C; text-align: center; padding: 24px 0; font-family: Georgia, serif;">
                    Aucun commentaire pour l'instant. Sois le premier !
                </p>
                @endforelse
            </div>

        </div>
    </div>

    <!-- Script Carrousel -->
    <script>
        let currentSlide = 0;
        const totalSlides = {{ $post->images->count() }};

        function updateCarousel() {
            const inner = document.getElementById('carousel-inner');
            const dots = document.querySelectorAll('.dot');
            if (inner) {
                inner.style.transform = `translateX(-${currentSlide * 100}%)`;
            }
            dots.forEach((dot, index) => {
                dot.style.background = index === currentSlide
                    ? '#F5E6D3'
                    : 'rgba(245,230,211,0.5)';
            });
        }

        function changeSlide(direction) {
            currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
            updateCarousel();
        }

        function goToSlide(index) {
            currentSlide = index;
            updateCarousel();
        }

        // Défilement automatique toutes les 3 secondes
        if (totalSlides > 1) {
            setInterval(() => {
                changeSlide(1);
            }, 3000);
        }
    </script>
</x-app-layout>