<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    //apak
    public function homepage()
    {
        $movies = Movie::latest()->paginate(6);
        return view('homepage', compact('movies'));
    }

    public function detail($id,$slug)
    {
        $movie = Movie::findOrfail($id);
        return view('detailmovie', compact('movie'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('layouts.create_movie', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'synopsis' => 'required',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|numeric|min:1900|max:' . date('Y'),
            'actors' => 'required',
            'cover_image' => 'required|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        $coverPath = $request->file('cover_image')->store('covers', 'public');

        Movie::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'synopsis' => $request->synopsis,
            'category_id' => $request->category_id,
            'year' => $request->year,
            'actors' => $request->actors,
            'cover_image' => $coverPath,
        ]);

        return redirect('/')->with('success', 'Movie berhasil ditambahkan!');
    }

    public function dataMovie()
    {
        $movies = Movie::with('category')->latest()->paginate(10);
        return view('dataMovie', compact('movies'));
    }

    public function edit(Movie $movie)   // Route: movies.edit
    {
        $categories = Category::all();
        return view('layouts.edit_movie', compact('movie', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'synopsis' => 'required',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|numeric|min:1900|max:' . date('Y'),
            'actors' => 'required',
            'cover_image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'synopsis' => $request->synopsis,
            'category_id' => $request->category_id,
            'year' => $request->year,
            'actors' => $request->actors,
        ];

        if ($request->hasFile('cover_image')) {
            if ($movie->cover_image && Storage::disk('public')->exists($movie->cover_image)) {
                Storage::disk('public')->delete($movie->cover_image);
            }
            $coverPath = $request->file('cover_image')->store('covers', 'public');
            $data['cover_image'] = $coverPath;
        }

        $movie->update($data);

        return redirect('/data-movie')->with('success', 'Data Movie berhasil diperbarui!');
    }


    public function destroy(Movie $movie)
    {
        if(Gate::allows('delete')) {
                //echo "Delete movie $id";

                        if ($movie->cover_image) {
                            Storage::disk('public')->delete($movie->cover_image);
                        }
                        $movie->delete();

                        return redirect('/data-movie')
                        ->with('success', 'Data Movie berhasil dihapus!');

             } else {
            abort(403, 'Error! Anda bukan Admin');
        }
    }

}
