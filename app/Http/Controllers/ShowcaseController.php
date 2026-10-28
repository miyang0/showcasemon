<?php

// this is a controller for where all showcase posts are shown // homepage

namespace App\Http\Controllers;

use App\Models\Showcase;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ShowcaseController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tags' => 'required|string|max:255'
        ]);

        $tagNames = $this->parseTags($validated['tags']);

        $data = collect($validated)->except(['tags', 'image'])->all();

        if ($request->hasFile('image')) {
            $data['image'] = file_get_contents($request->file('image')->getRealPath());
        }

        $showcase = $request->user()->showcases()->create($data);

        $this->syncTagsWithTables($showcase, $tagNames);

        return redirect()->route('showcase.create');
    }

    private function parseTags(string $input): Collection
    {
        $tagNames = collect(explode(',', $input))
            ->map(fn($tagNames) => trim($tagNames))
            ->filter()
            ->unique(fn($tagNames) => Str::lower($tagNames))
            ->values();

        if ($tagNames->isEmpty()) {
            throw ValidationException::withMessages(['tags' => 'This post needs at least 1 tag.']);
        }

        if ($tagNames->contains(fn($tagName) => mb_strlen($tagName) > 20)) {
            throw ValidationException::withMessages(['tags' => 'This tag can be at most 20 characters.']);
        }

        return $tagNames;

    }

    private function syncTagsWithTables(Showcase $showcase, Collection $tagNames): void
    {
        $ids = $tagNames->map(function ($tagName) {
            $tag = Tag::whereRaw('LOWER(name) =?', [Str::lower($tagName)])->first()
                ?? Tag::create(['name' => $tagName]);

            return $tag->id;
        });
        $showcase->tags()->sync($ids->all());
    }

    public function destroy(Showcase $showcase)
    {

        $showcase->delete();
        return redirect()->route('showcase.index');
    }

}
