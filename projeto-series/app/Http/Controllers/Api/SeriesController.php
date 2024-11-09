<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller
{

    public function __construct(private SeriesRepository $seriesRepository) 
    {
    }


    public function index()
    {
        return Series::all();
    }

    public function store(SeriesFormRequest $request)
    {

        return response()->json($this->seriesRepository->add($request), 201);
    }

    public function show(int $series)
    {
        $seriesModel = Series::with('seasons.episodes')->findOrFail($series);

        if ($seriesModel === null) {
            return response()->json(['message' => 'Series not found'], 404);
        }

        return response()->json(['serie' => $seriesModel], 200);
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

    public function destroy(int $series) {
        Series::destroy($series);
        return response()->noContent();
    }

}
