<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HasFetchAllRenderCapabilities;
use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\MovieCollection;

class ActorMovieController extends Controller
{
    use HasFetchAllRenderCapabilities;

    /**
     * Get all the movies where the actor has a role
     * GET actors/{actor}/movies
     *
     * @param Actor $actor
     * @return void
     */
    public function show(Actor $actor)
    {
        return new MovieCollection($actor->movies()->paginate());
    }
}
