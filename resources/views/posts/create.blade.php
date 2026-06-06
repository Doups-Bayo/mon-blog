<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family: Georgia, serif; color: #2C1810; font-size: 1.5rem; letter-spacing: 1px;">
            ✦ Créer un Post
        </h2>
    </x-slot>

    <div style="background: #FAF3E8; min-height: 100vh; padding: 40px 0;">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div style="background: #FFFDF7; border-radius: 16px; padding: 40px; box-shadow: 0 4px 20px rgba(44,24,16,0.08); border: 1px solid #E8D5C0;">

                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Titre -->
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; color: #2C1810; font-weight: bold; margin-bottom: 8px; font-family: Georgia, serif;">Titre</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                               style="width: 100%; border: 1px solid #E8D5C0; border-radius: 12px; padding: 12px 16px; font-size: 1rem; color: #4A3728; background: #FAF3E8; outline: none;"
                               placeholder="Titre de ton post">
                        @error('title')
                            <p style="color: #C0392B; font-size: 0.85rem; margin-top: 6px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contenu -->
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; color: #2C1810; font-weight: bold; margin-bottom: 8px; font-family: Georgia, serif;">Contenu</label>
                        <textarea name="content" rows="10"
                                  style="width: 100%; border: 1px solid #E8D5C0; border-radius: 12px; padding: 12px 16px; font-size: 1rem; color: #4A3728; background: #FAF3E8; resize: vertical; outline: none;"
                                  placeholder="Écris ton post ici...">{{ old('content') }}</textarea>
                        @error('content')
                            <p style="color: #C0392B; font-size: 0.85rem; margin-top: 6px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; color: #2C1810; font-weight: bold; margin-bottom: 8px; font-family: Georgia, serif;">Image (optionnel)</label>
                        <div style="border: 2px dashed #C8956C; border-radius: 12px; padding: 24px; text-align: center; background: #FAF3E8;">
                            <p style="color: #C8956C; margin-bottom: 12px;">🖼️ Choisir une image</p>
                            <input type="file" name="image" accept="image/*">
                        </div>
                        @error('image')
                            <p style="color: #C0392B; font-size: 0.85rem; margin-top: 6px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Catégories -->
                    @if($categories->count() > 0)
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; color: #2C1810; font-weight: bold; margin-bottom: 8px; font-family: Georgia, serif;">Catégories</label>
                        <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                            @foreach($categories as $category)
                            <label style="display: flex; align-items: center; gap: 6px; color: #4A3728; cursor: pointer;">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Boutons -->
                    <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 32px;">
                        <a href="{{ route('posts.index') }}"
                           style="background: #F5E6D3; color: #2C1810; padding: 10px 28px; border-radius: 25px; font-weight: bold; text-decoration: none; border: 1px solid #C8956C;">
                            Annuler
                        </a>
                        <button type="submit"
                                style="background: linear-gradient(135deg, #2C1810, #4A2C17); color: #F5E6D3; padding: 10px 28px; border-radius: 25px; font-weight: bold; border: none; cursor: pointer;">
                            ✦ Publier
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>