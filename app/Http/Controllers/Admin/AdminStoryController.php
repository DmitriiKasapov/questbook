<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminStoryController extends Controller
{
    public function index()
    {
        $stories = Story::orderBy('id')->get();
        return view('admin.stories.index', compact('stories'));
    }

    public function create()
    {
        return view('admin.stories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255', // ← ЭТО ОБЯЗАТЕЛЬНО
            'description' => 'nullable|string',
            'genre' => 'nullable|string',
            'is_published' => 'boolean',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('covers', 'public');
            $data['cover_image'] = $path;
        }

        Story::create($data);

        return redirect()->route('admin.panel')->with('success', 'История создана');
    }

    public function edit(Story $story)
    {
        return view('admin.stories.edit', compact('story'));
    }

    public function update(Request $request, Story $story)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255', // ← ЭТО ОБЯЗАТЕЛЬНО
            'description' => 'nullable|string',
            'genre' => 'nullable|string',
            'is_published' => 'boolean',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $data['is_published'] = $request->has('is_published');

        // Удаление старой обложки по чекбоксу
        if ($request->has('delete_cover') && $story->cover_image) {
            if (Storage::disk('public')->exists($story->cover_image)) {
                Storage::disk('public')->delete($story->cover_image);
            }
            $data['cover_image'] = null;
        }

        // Загрузка новой обложки (и удаление старой)
        if ($request->hasFile('cover_image')) {
            if ($story->cover_image && Storage::disk('public')->exists($story->cover_image)) {
                Storage::disk('public')->delete($story->cover_image);
            }
            $path = $request->file('cover_image')->store('covers', 'public');
            $data['cover_image'] = $path;
        }

        $story->update($data);

        return redirect()->route('admin.stories.edit', $story)->with('success', 'Изменения сохранены');
    }

    public function destroy(Story $story)
    {
        // Удалить обложку, если есть
        if ($story->cover_image && Storage::disk('public')->exists($story->cover_image)) {
            Storage::disk('public')->delete($story->cover_image);
        }

        $story->delete();

        return redirect()->route('admin.panel')->with('success', 'История удалена');
    }
}
