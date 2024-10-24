<?php

namespace App\Http\Controllers;

use App\Models\Season;

class EpisodesController
{
    public function index(Season $season){
        return view('seasons.index',['seasons' => $season->episodes]);
    }

}
