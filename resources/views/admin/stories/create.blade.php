@extends('layouts.app')

@section('content')
    <div class="content">
        <a href="{{ route('admin.stories.index') }}"
        class="inline-block mb-4 text-sm text-blue-600 hover:underline">
            ← Назад ко всем историям
        </a>
        <h1 class="mb-4 text-2xl font-bold">Добавить историю</h1>

        <form action="{{ route('admin.stories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block mb-1">Название</label>
                <input type="text" name="title" class="w-full p-2 border" required>
            </div>
            <div
                x-data="{
                    preview: null,
                    updatePreview(event) {
                        const file = event.target.files[0];
                        if (file) {
                            this.preview = URL.createObjectURL(file);
                        }
                    }
                }"
                class="mb-4"
            >
                <label class="block mb-1">Обложка (файл)</label>
                <input type="file" name="cover_image" @change="updatePreview" class="w-full p-2 border">

                <template x-if="preview">
                    <img :src="preview" class="object-cover w-32 h-32 mt-4 border rounded" />
                </template>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Краткое описание</label>
                <input type="text" name="short_description" class="w-full p-2 border rounded"
                    value="{{ old('short_description', $story->short_description) }}">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Описание</label>
                <textarea name="description" class="w-full p-2 border"></textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Жанр</label>
                <input type="text" name="genre" class="w-full p-2 border">
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_published" value="1" class="mr-2">
                    Опубликовать
                </label>
            </div>

            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded">Сохранить</button>
        </form>
    </div>

@endsection
