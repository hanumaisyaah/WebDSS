<?php

namespace App\Models;
use App\Models\criteria;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class criteria extends Model
{
    use HasFactory;
    protected $table = 'criteria';
    protected $guarded = [];
    public $timestamps = false;
}
