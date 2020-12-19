<?php

namespace App\Models;

use App\Models\Traits\PrimaryAsUuid;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;
use Illuminate\Support\Facades\DB;

class Actor extends Model
{
    use PrimaryAsUuid;

    public $incrementing = false;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $fillable = ['name', 'bio', 'born_at'];


    public function movies()
    {
        return $this->belongsToMany(Movie::class)->withPivot('name');
    }


    public function genres()
    {
        return DB::select("select g.*, count(g.name) as movie_count from actor_movie  as am
            inner join movies as m on am.movie_id = m.id
            inner join genre_movie as gm on gm.movie_id = m.id
            inner join genres as g on g.id = gm.genre_id
            inner join actors as a on a.id = am.actor_id
            where am.actor_id = :id
            group by g.name
            order by movie_count desc",
            ['id' => $this->id]
        );
    }

}
