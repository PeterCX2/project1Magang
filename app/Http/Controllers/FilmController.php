<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Film;

class FilmController extends Controller
{
    public function userIndex(){
        $categories = Category::with('films')->get();
        return view('user.index', compact('categories'));
    }

    public function adminIndex(){
        $films = Film::with('category')->paginate(8);
        return view('admin.index', compact('films'));
    }

    public function create(){
        $categories = Category::all();
        return view('admin.create', compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'link' => 'required|string|max:255',
            'category_id' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'publisher' => 'required|string|max:255',
            'release_date' => 'required|date',
        ]);
        Film::create($request->all());

        return redirect()->route('admin.index')->with('success', 'Film created successfully.');
    }

    public function edit($id){
        $film = Film::findOrFail($id);
        $categories = Category::all();
        return view('admin.edit', compact('film', 'categories'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'link' => 'required|string|max:255',
            'category_id' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'publisher' => 'required|string|max:255',
            'release_date' => 'required|date',
        ]);

        $film = Film::findOrFail($id);
        $film->update($request->all());

        return redirect()->route('admin.index')->with('success', 'Film updated successfully.');
    }

    public function delete($id){
        $film = Film::findOrFail($id);
        $film->delete();

        return redirect()->route('admin.index')->with('success', 'Film deleted successfully.');
    }
}
