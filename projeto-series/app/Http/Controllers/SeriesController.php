<?php

namespace App\Http\Controllers;

use App\Events\SeriesCreated;
use App\Http\Requests\SeriesFormRequest;
use App\Jobs\DestroyImageSerie;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeriesController extends Controller
{

    public function __construct(private SeriesRepository $repository)
    {
        $this->middleware('auth')->except('index');
    }

    public function index(Request $request)
    {
        $series = Series::all();
        $mensagemSucesso = session('mensagem.sucesso');

        return view('series.index')->with('series', $series)->with('mensagemSucesso', $mensagemSucesso);

    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {

        $coverPath = $request->hasFile('cover')
                     ? $request->file('cover')->store('series_cover','public')
                     : null;
        $request->coverPath = $coverPath;

        $serie = $this->repository->add($request);

        SeriesCreated::dispatch(
            $serie->nome,
            $serie->id,
            $request->seasonsQty,
            $request->episodesPerSeason,
        );

        return to_route('series.index')->with('mensagem.sucesso', "Series '{$serie->nome}' cadastrada com sucesso!");
    }

    public function edit(Series $series)
    {
        return view('series.edit')->with('serie', $series);
    }

    public function update(Series $series, Request $request){

        $series->fill($request->all());
        $series->save();

        return to_route('series.index')->with('mensagem.sucesso', "Series '{$series->nome}' atualizada com sucesso!");
    }

    public function destroy(Series $series, Request $request){
        
        if (!is_null($series->cover)) {
            DestroyImageSerie::dispatch($series->cover);
        }

        $series->delete();

        return to_route('series.index')->with('mensagem.sucesso', "Series '{$series->nome}' removida com sucesso!");
    }
}
