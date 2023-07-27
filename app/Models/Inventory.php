<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable = [
        'inventory_name',
        'information',
        'sum', 
        'type_id',
        'room_id',
        'inventory_code'
    ];  

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
}
