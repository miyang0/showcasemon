<?php

// this is a controller for individual posts

namespace App\Http\Controllers;

use App\Models\Showcase;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'tag' => 'required|string'
        ]);

        $showcase = new Showcase();
        $showcase->title = $request->input('title');
        $showcase->description = $request->input('description');
        $showcase->tag = $request->input('tag');
        $showcase->user_id = auth()->id();
        $showcase->save();


        return redirect()->route('showcase.create');

    }

    public function destroy(Showcase $showcase)
    {

        $showcase->delete();
        return redirect()->route('showcase.index');
    }
}
