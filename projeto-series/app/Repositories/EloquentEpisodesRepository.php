<?php

namespace App\Repositories;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Support\Facades\DB;

class EloquentEpisodesRepository implements EpisodesRepository
{
    public function update(array $data, int $id)
    {
        return DB::transaction(function () use ($data, $id) {


            $watchedEpisodes = $data['episodes'];
            
            Episode::whereIn('id',$watchedEpisodes)->update(['watched' => true]);

            return true;
        });
    }
}
