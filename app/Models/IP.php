<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IP extends Model
{
    use HasFactory;
    protected $table = 'ip';
    protected $guarded = ['id'];
    public $timestamps = false;
}
