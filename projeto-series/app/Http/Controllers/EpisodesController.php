<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use App\Repositories\EpisodesRepository;
use Illuminate\Http\Request;

class EpisodesController
{

    public function __construct(private EpisodesRepository $repository)
    {
    }

    public function index(Season $season){
        return view('episodes.index',['episodes' => $season->episodes]);
    }

    public function update(Request $request, Season $season) {

        $data = [
            'episodes' => $request->episodes
        ];

        $this->repository->update($data, $season->id);

        return to_route('episodes.index', $season->id);
    }

}
