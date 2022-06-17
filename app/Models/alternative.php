<?php

namespace App\Models;
use App\Models\alternative;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alternative extends Model
{
    use HasFactory;
    protected $table = 'alternative';
    protected $guarded = [];
    public $timestamps = false;
}
