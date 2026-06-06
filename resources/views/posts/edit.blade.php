<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier le Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">

                <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Titre -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Titre</label>
                        <input type="text" name="title" value="{{ old('title', $post->title) }}"
                               class="w-full border rounded px-3 py-2 @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contenu -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Contenu</label>
                        <textarea name="content" rows="10"
                                  class="w-full border rounded px-3 py-2 @error('content') border-red-500 @enderror">{{ old('content', $post->content) }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Image (optionnel)</label>
                        @if($post->image)
                            <img src="{{ Storage::url($post->image) }}"
                                 class="w-32 h-32 object-cover rounded mb-2" alt="Image actuelle">
                        @endif
                        <input type="file" name="image" accept="image/*"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <!-- Catégories -->
                    @if($categories->count() > 0)
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Catégories</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach($categories as $category)
                            <label class="flex items-center gap-1">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                    {{ $post->categories->contains($category->id) ? 'checked' : '' }}>
                                {{ $category->name }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Boutons -->
                    <div class="flex justify-end">
                        <a href="{{ route('posts.show', $post->slug) }}"
                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Annuler
                        </a>
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Mettre à jour
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>