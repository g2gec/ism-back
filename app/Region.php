<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Region extends Eloquent
{
    protected $connection = 'mongodb_regions';
    protected $collection = 'reviews';

    protected $fillable = [];
}
