<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KoordinatorTPS extends Model
{
    use HasFactory;
    protected $table = 'koordinator_tps';
    protected $guarded = ['id'];
    public $timestamps = false;
}
