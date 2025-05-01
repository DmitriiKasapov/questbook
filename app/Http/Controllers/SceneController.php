<?php

namespace App\Http\Controllers;

use App\Models\Scene;
use Illuminate\Http\Request;

class SceneController extends Controller
{
    public function show(Scene $scene)
    {
        return view('scenes.show', compact('scene'));
    }
}
