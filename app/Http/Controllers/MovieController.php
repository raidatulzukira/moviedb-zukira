<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    // public function index()
    // {
    //     $movies = Movie::with('category')->paginate(10);
    //     return view('movie.index', compact('movies'));
    // }

    // public function create()
    // {
    //     $categories = Category::all();
    //     return view('movie.create', compact('categories'));
    // }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'synopsis' => 'nullable|string',
    //         'category_id' => 'required|exists:categories,id',
    //         'year' => 'required|digits:4|integer',
    //         'actors' => 'nullable|string',
    //         'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     // Buat slug unik dari title
    //     $validated['slug'] = $this->generateUniqueSlug($validated['title']);

    //     // Upload cover image jika ada
    //     if ($request->hasFile('cover_image')) {
    //         $file = $request->file('cover_image');
    //         $filename = time() . '_' . $file->getClientOriginalName();
    //         $file->storeAs('public/covers', $filename);
    //         $validated['cover_image'] = $filename;
    //     }

    //     Movie::create($validated);

    //     return redirect()->route('create-movie')->with('success', 'Movie berhasil ditambahkan!');
    // }

    // public function edit(string $id)
    // {
    //     $movie = Movie::findOrFail($id);
    //     $categories = Category::all();
    //     return view('movie.edit', compact('movie', 'categories'));
    // }

    // public function update(Request $request, string $id)
    // {
    //     $validated = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'synopsis' => 'nullable|string',
    //         'category_id' => 'required|exists:categories,id',
    //         'year' => 'required|digits:4|integer',
    //         'actors' => 'nullable|string',
    //         'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     $movie = Movie::findOrFail($id);

    //     // Update slug jika title berubah
    //     if ($movie->title !== $validated['title']) {
    //         $validated['slug'] = $this->generateUniqueSlug($validated['title']);
    //     } else {
    //         $validated['slug'] = $movie->slug;
    //     }

    //     // Upload cover image baru jika ada dan hapus yang lama
    //     if ($request->hasFile('cover_image')) {
    //         if ($movie->cover_image && Storage::exists('public/covers/' . $movie->cover_image)) {
    //             Storage::delete('public/covers/' . $movie->cover_image);
    //         }

    //         $file = $request->file('cover_image');
    //         $filename = time() . '_' . $file->getClientOriginalName();
    //         $file->storeAs('public/covers', $filename);
    //         $validated['cover_image'] = $filename;
    //     }

    //     $movie->update($validated);

    //     return redirect()->route('movie.index')->with('success', 'Movie berhasil diupdate!');
    // }

    // public function destroy(string $id)
    // {
    //     $movie = Movie::findOrFail($id);

    //     // Hapus cover image dari storage
    //     if ($movie->cover_image && Storage::exists('public/covers/' . $movie->cover_image)) {
    //         Storage::delete('public/covers/' . $movie->cover_image);
    //     }

    //     $movie->delete();

    //     return redirect()->route('movie.index')->with('success', 'Movie berhasil dihapus.');
    // }

    // // Helper method untuk membuat slug unik
    // private function generateUniqueSlug($title)
    // {
    //     $slug = Str::slug($title);
    //     $original = $slug;
    //     $count = 1;

    //     while (Movie::where('slug', $slug)->exists()) {
    //         $slug = $original . '-' . $count++;
    //     }

    //     return $slug;
    // }

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
        // $validated = $request->validate(
        //     [
        //         'title' => 'required|string|max:255',
        //         'synopsis' => 'nullable|string',
        //         'category_id' => 'required|exists:categories,id',
        //         'year' => 'required|integer|min:1950|max:'.date('Y'),
        //         'actors' => 'required|string',
        //         'cover_image' => 'nullable|image|mimes:jpg,jpeg,webp'
        //     ]
        //     );

        //     $slug = Str::slug($request->title);

        //     //ambil input file dan simpan ke storage
        //     $cover = null;
        //     ifm($request->hasFile('cover_image')) {
        //         $cover = $request->file('cover_image')->storage('covers', 'public');
        //     }

        //     //simpan ke tabel movies
        //     Movie::create(
        //         [
        //             'title' => $validated['title'],
        //             'slug' => $slug,
        //             'synopsis' => $validated['synopsis'],
        //             'category_id' => $validated['category_id'],
        //             'year' => $validated['year'],
        //             'actors' => $validated['actors'],
        //             'cover_image' => $cover,
        //         ]
        //         );

        //         return redirect('/')->with('success', 'Movie saved successfully!');





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

    // public function dataMovie()
    // {
    //     $movies = Movie::latest()->paginate(10);
    //     return view('dataMovie', compact('movie'));
    // }

    public function dataMovie()
    {
        $movies = Movie::with('category')->latest()->paginate(10);
        return view('dataMovie', compact('movies'));
    }





}
