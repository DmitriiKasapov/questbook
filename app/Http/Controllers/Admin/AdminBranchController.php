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
            'title' => 'required|string|max:255',
        ]);

        $data['type'] = 'branch'; // по умолчанию

        Branch::create($data);

        return back()->with('success', 'Ветка добавлена.');
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();

        return back()->with('success', 'Ветка удалена.');
    }
}
