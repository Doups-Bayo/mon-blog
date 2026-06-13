<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family: Georgia, serif; color: #2C1810; font-size: 1.5rem; letter-spacing: 1px;">
            ✦ Modifier le Post
        </h2>
    </x-slot>

    <div style="background: #FAF3E8; min-height: 100vh; padding: 40px 0;">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div style="background: #FFFDF7; border-radius: 16px; padding: 40px; box-shadow: 0 4px 20px rgba(44,24,16,0.08); border: 1px solid #E8D5C0;">

                <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Titre -->
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; color: #2C1810; font-weight: bold; margin-bottom: 8px; font-family: Georgia, serif;">Titre</label>
                        <input type="text" name="title" value="{{ old('title', $post->title) }}"
                               style="width: 100%; border: 1px solid #E8D5C0; border-radius: 12px; padding: 12px 16px; font-size: 1rem; color: #4A3728; background: #FAF3E8; outline: none;">
                        @error('title')
                            <p style="color: #C0392B; font-size: 0.85rem; margin-top: 6px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contenu -->
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; color: #2C1810; font-weight: bold; margin-bottom: 8px; font-family: Georgia, serif;">Contenu</label>
                        <textarea name="content" rows="10"
                                  style="width: 100%; border: 1px solid #E8D5C0; border-radius: 12px; padding: 12px 16px; font-size: 1rem; color: #4A3728; background: #FAF3E8; resize: vertical; outline: none;">{{ old('content', $post->content) }}</textarea>
                        @error('content')
                            <p style="color: #C0392B; font-size: 0.85rem; margin-top: 6px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image principale -->
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; color: #2C1810; font-weight: bold; margin-bottom: 8px; font-family: Georgia, serif;">Image principale</label>
                        @if($post->image)
                            <img src="{{ Storage::url($post->image) }}"
                                 style="width: 200px; height: 120px; object-fit: cover; border-radius: 8px; margin-bottom: 12px; border: 2px solid #C8956C;">
                            <p style="color: #7A5C45; font-size: 0.85rem; margin-bottom: 8px;">Image actuelle ↑ — Choisir une nouvelle pour remplacer</p>
                        @endif
                        <div style="border: 2px dashed #C8956C; border-radius: 12px; padding: 24px; text-align: center; background: #FAF3E8;">
                            <p style="color: #C8956C; margin-bottom: 12px;">🖼️ Image de couverture</p>
                            <input type="file" name="image" accept="image/*">
                        </div>
                        @error('image')
                            <p style="color: #C0392B; font-size: 0.85rem; margin-top: 6px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Images carrousel existantes -->
                    @if($post->images->count() > 0)
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; color: #2C1810; font-weight: bold; margin-bottom: 8px; font-family: Georgia, serif;">Images carrousel actuelles</label>
                        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                            @foreach($post->images as $image)
                            <div style="position: relative;">
                                <img src="{{ Storage::url($image->image_path) }}"
                                     style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px; border: 2px solid #C8956C;">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Nouvelles images carrousel -->
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; color: #2C1810; font-weight: bold; margin-bottom: 8px; font-family: Georgia, serif;">Ajouter des images au carrousel</label>
                        <div style="border: 2px dashed #C8956C; border-radius: 12px; padding: 24px; text-align: center; background: #FAF3E8;">
                            <p style="color: #C8956C; margin-bottom: 4px;">🎠 Ajouter plusieurs images</p>
                            <p style="color: #7A5C45; font-size: 0.85rem; margin-bottom: 12px;">Tu peux sélectionner plusieurs photos en même temps</p>
                            <input type="file" name="images[]" accept="image/*" multiple
                                   onchange="previewImages(this)">
                        </div>
                        <div id="preview-container" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 12px;"></div>
                    </div>

                    <!-- Catégories -->
                    @if($categories->count() > 0)
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; color: #2C1810; font-weight: bold; margin-bottom: 8px; font-family: Georgia, serif;">Catégories</label>
                        <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                            @foreach($categories as $category)
                            <label style="display: flex; align-items: center; gap: 6px; color: #4A3728; cursor: pointer;">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                    {{ $post->categories->contains($category->id) ? 'checked' : '' }}>
                                {{ $category->name }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Boutons -->
                    <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 32px;">
                        <a href="{{ route('posts.show', $post->slug) }}"
                           style="background: #F5E6D3; color: #2C1810; padding: 10px 28px; border-radius: 25px; font-weight: bold; text-decoration: none; border: 1px solid #C8956C;">
                            Annuler
                        </a>
                        <button type="submit"
                                style="background: linear-gradient(135deg, #2C1810, #4A2C17); color: #F5E6D3; padding: 10px 28px; border-radius: 25px; font-weight: bold; border: none; cursor: pointer;">
                            ✦ Mettre à jour
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        function previewImages(input) {
            const container = document.getElementById('preview-container');
            container.innerHTML = '';
            if (input.files) {
                Array.from(input.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.style.cssText = 'position: relative; width: 100px; height: 100px;';
                        div.innerHTML = `<img src="${e.target.result}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px; border: 2px solid #C8956C;">`;
                        container.appendChild(div);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }
    </script>
</x-app-layout>