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
    public function create(Request $request)
    {
        $storyId = $request->get('story_id');
        $branchId = $request->get('branch_id');

        $story = $storyId ? \App\Models\Story::with('branches')->findOrFail($storyId) : null;
        $branch = $branchId ? \App\Models\Branch::find($branchId) : null;


        return view('admin.scenes.create', compact('story', 'branch'));
    }

    // Сохранение новой сцены
    public function store(Request $request)
    {

        $validated = $request->validate([
            'story_id' => 'required|exists:stories,id',
            'branch_id' => 'required|exists:branches,id', // ✅ это важно!
            'type' => 'required|in:main,branch,ending',
            'content' => 'required|string',
            'choice_1_text' => 'nullable|string|max:255',
            'choice_1_target_scene_id' => 'nullable|integer|exists:scenes,id',
            'choice_2_text' => 'nullable|string|max:255',
            'choice_2_target_scene_id' => 'nullable|integer|exists:scenes,id',
        ]);

        \App\Models\Scene::create([
            'story_id' => $validated['story_id'],
            'branch_id' => $validated['branch_id'], // ✅ здесь сохранить
            'type' => $validated['type'],
            'content' => $validated['content'],
            'choice_1_text' => $validated['choice_1_text'],
            'choice_1_target_scene_id' => $validated['choice_1_target_scene_id'],
            'choice_2_text' => $validated['choice_2_text'],
            'choice_2_target_scene_id' => $validated['choice_2_target_scene_id'],
        ]);

        return redirect()
            ->to(route('admin.stories.edit', $validated['story_id']) . '#branches')
            ->with('success', 'Сцена добавлена.');


    }

    // Форма редактирования сцены
    public function edit(Scene $scene)
    {
        $story = $scene->story()->with('branches')->first();
        $stories = \App\Models\Story::all();

        return view('admin.scenes.edit', compact('scene', 'story', 'stories'));
    }

    // Обновление сцены
    public function update(Request $request, Scene $scene)
    {
        $data = $request->validate([
            'story_id' => 'required|exists:stories,id',
            'branch_id' => 'required|exists:branches,id',
            'content' => 'required|string',
            'choice_1_text' => 'nullable|string',
            'choice_1_target_scene_id' => 'nullable|integer|exists:scenes,id',
            'choice_2_text' => 'nullable|string',
            'choice_2_target_scene_id' => 'nullable|integer|exists:scenes,id',
        ]);

        $scene->update($data);

        return redirect()
            ->to(route('admin.stories.edit', $data['story_id']) . '#scenes')
            ->with('success', 'Сцена обновлена.');
    }
    // Удаление сцены
    public function destroy(\App\Models\Scene $scene)
    {
        $scene->delete();

        return redirect()->route('admin.scenes.index')->with('success', 'Сцена удалена!');
    }
}
