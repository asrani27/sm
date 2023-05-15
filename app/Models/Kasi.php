<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasi extends Model
{
    use HasFactory;
    protected $table = 'kasi';
    protected $guarded = ['id'];
    public $timestamps = false;
}
