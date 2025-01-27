<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionsItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'requisition_id',
        'equipment_id',
        'quantity',
        'remarks'
    ];


    public function serials()
    {
        return $this->hasMany(RequisitionItemsSerial::class,  'requisition_items_id');
    }
}
