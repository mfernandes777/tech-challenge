<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HasFetchAllRenderCapabilities;
use App\Http\Requests\ActorRequest;
use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\MovieCollection;

class ActorController extends Controller
{
    use HasFetchAllRenderCapabilities;

    /**
     * Display a listing of the resource.
     * GET /api/actors
     *
     * @param Request $request
     * @return ResourceCollection
     */
    public function index(Request $request)
    {
        $this->setGetAllBuilder(Actor::query());
        $this->setGetAllOrdering('name', 'asc');
        $this->parseRequestConditions($request);
        return new ResourceCollection($this->getAll()->paginate());
    }

    /**
     * Show the form for creating a new resource.
     * POST /api/actors
     *
     * @param ActorRequest $request
     * @return \App\Http\Resources\Actor
     */
    public function store(ActorRequest $request)
    {
        $actor = new Actor($request->validated());
        $actor->save();

        return new \App\Http\Resources\Actor($actor);
    }

    /**
     * Show the resource
     * GET /api/actors/{id}
     *
     * @param Actor $actor
     * @return \App\Http\Resources\Actor
     */
    public function show(Actor $actor)
    {
        return new \App\Http\Resources\Actor($actor);
    }

    /**
     * Update the specified resource in storage.
     * PUT /api/actors/{id}
     *
     * @param Actor $actor
     * @param ActorRequest $request
     * @return \App\Http\Resources\Actor
     */
    public function update(Actor $actor, ActorRequest $request)
    {
        $actor->fill($request->validated());
        $actor->save();

        return new \App\Http\Resources\Actor($actor);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /api/actors/{id}
     *
     * @param Actor $actor
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Actor $actor)
    {
        $actor->delete();

        return response()->noContent();
    }

    /**
     * Get all the movies where the actor has a role
     * GET actors/{actor}/movies
     *
     * @param Actor $actor
     * @return void
     */
    public function movies(Actor $actor)
    {
        return new MovieCollection($actor->movies()->paginate());
    }


    /**
     * Get all the genres of an actor
     * GET actors/{actor}/genres
     *
     * @param Actor $actor
     * @return void
     */
    public function genres(Actor $actor)
    {
        return $actor->genres();
    }

}
