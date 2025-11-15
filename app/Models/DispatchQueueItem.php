<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DispatchQueueItem extends Model
{
    use HasFactory;

    protected $connection = 'mysql_second';
    
    protected $table = 'dispatch_queue_items';
    
    protected $fillable = [
        'dispatch_queue_id',
        'item_name',
        'status',
        'priority',
        'assigned_to',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
