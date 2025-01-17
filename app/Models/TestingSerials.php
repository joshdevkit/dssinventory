<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestingSerials extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'serial_no', 'condition'];
}
