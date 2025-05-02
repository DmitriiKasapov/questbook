<?php

namespace App\Http\Controllers\Admin;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminBranchController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'story_id' => 'required|exists:stories,id',
            'chapter_key' => 'required|string',
            'title' => 'required|string|max:255',
        ]);

        \App\Models\Branch::create($data);

        return redirect()
            ->to(route('admin.stories.edit', $data['story_id']) . '?tab=chapters&chapter=' . $data['chapter_key'])
            ->with('success', 'Ветка добавлена.');
    }
    public function destroy(Branch $branch)
    {
        $branch->delete();

        return back()->with('success', 'Ветка удалена.');
    }
}
