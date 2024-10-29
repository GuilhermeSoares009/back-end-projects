<?php

namespace App\Repositories;

use App\Models\Episode;

interface EpisodesRepository
{
    public function update(array $data, int $id);
}