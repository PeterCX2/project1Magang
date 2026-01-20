<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Film;
use App\Http\Resources\FilmResource;
use Illuminate\Http\Request;


class FilmController extends Controller
{
    public function index()
    {
        $film = Film::with('category')->get();
        $data = [
            'status' => 'success',
            'msg' => 'data successfully show',
            'data' => FilmResource::collection($film)
        ];
        return response()->json($data);
    }

    public function store(Request $request){
        $request->validate([
            'link' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'publisher' => 'required|string|max:255',
            'release_date' => 'required|date',
        ]);
        $film = Film::create($request->all());

        $data = [
            'status' => 'success',
            'msg' => 'data successfully added',
            'data' => new FilmResource($film->load('category'))
        ];
        return response()->json($data, 201);   

        // return response()->json(['test' => 'masuk']);
    }

    public function delete($id){
        $film = Film::findOrFail($id);
        $film->delete();

        $data = [
            'status' => 'success',
            'msg' => 'data successfully deleted',
            'data' => new FilmResource($film->load('category'))
        ];

        return response()->json($data);;
    }
}
