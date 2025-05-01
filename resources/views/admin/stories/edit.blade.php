@extends('layouts.app')

@section('content')
<div class="content">
    <h1 class="mb-4 text-2xl font-bold">Редактировать историю</h1>

    {{-- Кнопка назад --}}
    <a href="{{ route('admin.panel') }}" class="inline-block mb-4 text-sm text-blue-600 hover:underline">
        ← Назад ко всем историям
    </a>
     @if (session('success'))
        <div class="px-4 py-2 mb-4 text-green-800 bg-green-100 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.stories.update', $story) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Название --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Название</label>
            <input type="text" name="title" class="w-full p-2 border rounded"
                   value="{{ old('title', $story->title) }}" required>
        </div>

        <div
            x-data="{
                preview: null,
                coverImage: '{{ $story->cover_image }}',
                updatePreview(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.preview = URL.createObjectURL(file);
                        this.coverImage = null;
                        this.$refs.deleteInput.checked = true;
                    }
                },
                clearFile() {
                    this.preview = null;
                    this.$refs.input.value = null;
                    if (!this.coverImage) {
                        this.$refs.deleteInput.checked = false;
                    } else {
                        this.$refs.deleteInput.checked = true;
                    }
                },
                removeExisting() {
                    this.coverImage = null;
                    this.$refs.deleteInput.checked = true;
                }
            }"
            class="mb-4"
        >
            <label class="block mb-1 font-semibold">Обложка</label>
            <input type="file" name="cover_image" x-ref="input" @change="updatePreview"
                class="w-full p-2 border rounded">

            <div class="relative inline-block mt-4" x-cloak>
                <template x-if="preview">
                    <img :src="preview" class="object-cover w-32 h-32 border rounded">
                </template>

                <template x-if="!preview && coverImage">
                    <img :src="'/storage/' + coverImage" class="object-cover w-32 h-32 border rounded">
                </template>

                {{-- Кнопка ❌ удаляет и превью, и старую обложку --}}
                <button type="button"
                        @click="preview ? clearFile() : removeExisting()"
                        class="absolute top-0 right-0 flex items-center justify-center w-6 h-6 text-red-600 bg-white rounded-full shadow hover:bg-red-100"
                        x-show="preview || coverImage">
                    &times;
                </button>
            </div>

            <input type="checkbox" name="delete_cover" value="1" x-ref="deleteInput" class="hidden">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Краткое описание</label>
            <input type="text" name="short_description"
                value="{{ old('short_description', $story->short_description) }}"
                class="w-full p-2 border rounded">
        </div>
        {{-- Описание --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Описание</label>
            <textarea name="description" class="w-full p-2 border rounded" rows="4">{{ old('description', $story->description) }}</textarea>
        </div>

        {{-- Жанр --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Жанр</label>
            <input type="text" name="genre" class="w-full p-2 border rounded"
                   value="{{ old('genre', $story->genre) }}">
        </div>

        {{-- Опубликовать --}}
        <div class="mb-4">
            <label class="inline-flex items-center font-semibold">
                <input type="checkbox" name="is_published" value="1" class="mr-2"
                       @checked(old('is_published', $story->is_published))>
                Опубликовать
            </label>
        </div>

        {{-- Кнопка сохранить --}}
        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
            Сохранить изменения
        </button>
        @if (session('success'))
            <div class="px-4 py-2 mb-4 text-green-800 bg-green-100 rounded">
                {{ session('success') }}
            </div>
        @endif
    </form>
</div>

@endsection
