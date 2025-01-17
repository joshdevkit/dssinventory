<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeRequest extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'item_type', 'quantity_requested', 'requested_by', 'purpose', 'status', 'is_notified'];

    public function itemsOnRequest()
    {
        return $this->morphTo();
    }


    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'item_id');
    }
}
