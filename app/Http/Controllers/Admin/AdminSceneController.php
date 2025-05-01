<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Scene;
use App\Models\Story;
use Illuminate\Http\Request;

class AdminSceneController extends Controller
{
    // Список всех сцен
    public function index(Request $request)
    {
        $query = \App\Models\Scene::with('story')->orderBy('id');

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $scenes = $query->get();

        // Типы можно получить из базы (distinct) или захардкодить
        $availableTypes = \App\Models\Scene::distinct()->pluck('type')->sort()->values();

        return view('admin.scenes.index', compact('scenes', 'availableTypes'));
    }

    // Форма создания новой сцены
    public function create()
    {
        $stories = \App\Models\Story::orderBy('title')->get();
        $allScenes = \App\Models\Scene::orderBy('id')->get(); // все существующие сцены
        return view('admin.scenes.create', compact('stories', 'allScenes'));
    }

    // Сохранение новой сцены
    public function store(Request $request)
    {
        $data = $request->validate([
            'story_id' => 'required|exists:stories,id',
            'type' => 'required|string|max:50',
            'content' => 'required|string',
            'choice_1_text' => 'nullable|string',
            'choice_1_target_scene_id' => 'nullable|integer|exists:scenes,id',
            'choice_2_text' => 'nullable|string',
            'choice_2_target_scene_id' => 'nullable|integer|exists:scenes,id',
        ]);

        Scene::create($data);

        return redirect()->route('admin.scenes.index')->with('success', 'Сцена добавлена!');
    }

    // Форма редактирования сцены
    public function edit(Scene $scene)
    {
        $stories = Story::orderBy('title')->get();
        return view('admin.scenes.edit', compact('scene', 'stories'));
    }

    // Обновление сцены
    public function update(Request $request, Scene $scene)
    {
        $data = $request->validate([
            'story_id' => 'required|exists:stories,id',
            'type' => 'required|string|max:50',
            'content' => 'required|string',
            'choice_1_text' => 'nullable|string',
            'choice_1_target_scene_id' => 'nullable|integer|exists:scenes,id',
            'choice_2_text' => 'nullable|string',
            'choice_2_target_scene_id' => 'nullable|integer|exists:scenes,id',
        ]);

        $scene->update($data);

        return redirect()->route('admin.scenes.index')->with('success', 'Сцена обновлена!');
    }

    // Удаление сцены
    public function destroy(\App\Models\Scene $scene)
    {
        $scene->delete();

        return redirect()->route('admin.scenes.index')->with('success', 'Сцена удалена!');
    }
}
