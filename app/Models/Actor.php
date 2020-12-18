<?php

namespace App\Models;

use App\Models\Traits\PrimaryAsUuid;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;

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

}
