<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionItemsSerial extends Model
{
    use HasFactory;

    protected $fillable = [
        'requisition_items_id',
        'equipment_id',
        'equipment_serial_id'
    ];
}
