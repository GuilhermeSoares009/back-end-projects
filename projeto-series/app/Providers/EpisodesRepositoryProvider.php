<?php

namespace App\Providers;

use App\Repositories\EloquentEpisodesRepository;
use App\Repositories\EloquentSeriesRepository;
use App\Repositories\EpisodesRepository;
use Illuminate\Support\ServiceProvider;

class EpisodesRepositoryProvider extends ServiceProvider
{
  public array $bindings = [
    EpisodesRepository::class => EloquentEpisodesRepository::class
  ];
}
