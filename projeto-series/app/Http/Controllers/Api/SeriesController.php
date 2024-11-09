<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{


    public function index()
    {
        return Series::all();
    }

    public function store(SeriesFormRequest $request)
    {

        $coverPath = $request->hasFile('cover')
            ? $request->file('cover')->store('series_cover', 'public')
            : null;

            $data = [
                'nome' => $request->input('nome'),
                'cover' => $coverPath
            ];
        

        $series = Series::create($data);

        return response()->json($series, 201);
    }

    public function update(SeriesFormRequest $request, Series $series)
    {
        $data = $request->validated();

        if (isset($data['cover'])) {
            $data['cover'] = $request->file('cover')->store('series_cover', 'public');
        }
    
        $series->update($data);
    
        return response()->json($series, 200);
    }

    public function show($id)
    {
        $series = Series::find($id);

        if ($series) {
            return response()->json($series);
        }

        return response()->json(['error' => 'Série não encontrada'], 404);
    }

}
